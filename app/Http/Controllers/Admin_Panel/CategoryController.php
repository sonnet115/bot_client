<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Category;
use App\DeliveryCharge;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function viewAddCategoryForm()
    {
        if (request()->get('mode')) {
            $catid = request()->get('catid');
            $cat_details = Category::where('id', $catid)->with('shop')->first();
            if ($cat_details->shop->page_connected_status != 1) {
                return redirect(route('category.manage.view'));
            }

            if ($cat_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('category.manage.view'));
            }
        } else {
            $cat_details = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();

        return view('admin_panel.category.add_category')
            ->with("title", "Howkar Technology | Add Category")
            ->with('category_details', $cat_details)
            ->with('shop_list', $shops);
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cat = new Category();
        $cat->name = $request->category_name;
        $cat->shop_id = $request->shop_id;
        $cat->save();
        return redirect(route('category.add.view'));
    }

    public function viewUpdateCategory()
    {
        return view("admin_panel.category.category_lists")->with("title", "Howkar Technology || Category Manage");
    }

    public function getCategory(Category $category)
    {
        $category = $category->newQuery();

        $shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $category->whereIn('shop_id', $shops_id);

        if (auth()->user()->page_added > 0) {
            return datatables($category->orderBy('id', 'asc')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cat = Category::find($request->category_id);
        $cat->name = $request->category_name;
        $cat->shop_id = $request->shop_id;
        $cat->save();
        return redirect(route('category.manage.view'));
    }

}
