<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Discount;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function viewAddDiscountForm()
    {
        if (request()->get('mode')) {
            $did = request()->get('did');
            $discount_details = Discount::where('id', $did)->with('shop')->first();
            if ($discount_details->shop->page_connected_status != 1) {
                return redirect(route('discount.manage.view'));
            }

            if ($discount_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('discount.manage.view'));
            }
        } else {
            $discount_details = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();

        return view("admin_panel.discount.add_discount_form")
            ->with("title", "Howkar Technology || Add Discount")
            ->with('discount_details', $discount_details)
            ->with('shop_list', $shops);
    }

    public function viewUpdateDiscount()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $products = Product::select('name', 'id')->whereIn('shop_id', $shops_id)->get();

        return view("admin_panel.discount.manage_discount")->with("title", "Howkar Technology || Manage Discount")->with('products', $products);
    }

    public function storeDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_from' => 'required',
            'discount_to' => 'required',
            'product_id' => 'required',
            'shop_id' => 'required',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $discount = new Discount();
            $discount->name = $request->discount_name;
            $discount->dis_from = $request->discount_from;
            $discount->dis_to = $request->discount_to;
            $discount->pid = $request->product_id;
            $discount->dis_percentage = $request->discount_percentage;
            $discount->shop_id = $request->shop_id;
            $discount->save();
            Session::flash('success_message', 'Discount Saved Successfully');
        } catch (\Exception $e) {
            Session::flash('error_message', 'Something went wrong. Please Try again!');
        }
        return redirect(route('discount.add.view'));
    }

    public function getDiscount(Discount $discount)
    {
        $discount = $discount->newQuery();

        if (request()->has('start_date') && request('start_date') != null && request('end_date') == null) {
            $discount->where('dis_from', '=', request('start_date'));
        }

        if (request()->has('end_date') && request('end_date') != null && request('start_date') == null) {
            $discount->where('dis_to', '=', request('end_date'));
        }

        if (request()->has('start_date') && request()->has('end_date') && request('start_date') != null && request('end_date') != null) {
            $discount->where('dis_from', '>=', request('start_date'))
                ->where('dis_to', '<=', request('end_date'));
        }

        if (request()->has('pid') && request('pid') != "") {
            $discount->whereIn('pid', request('pid'));
        }

        $shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $discount->whereIn('shop_id', $shops_id);

        if (auth()->user()->page_added > 0) {
            return datatables($discount->orderBy('id', 'asc')->with('product')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_from' => 'required',
            'discount_to' => 'required',
            'product_id' => 'required',
            'shop_id' => 'required',
            'state' => 'required',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $discount = Discount::find($request->discount_id);
            $discount->name = $request->discount_name;
            $discount->dis_from = $request->discount_from;
            $discount->dis_to = $request->discount_to;
            $discount->pid = $request->product_id;
            $discount->dis_percentage = $request->discount_percentage;
            $discount->shop_id = $request->shop_id;
            $discount->state = $request->state;
            $discount->save();

            Session::flash('success_message', 'Discount Updated Successfully');
        } catch (\Exception $e) {
            Session::flash('error_message', 'Something went wrong. Please Try again!');
        }
        return redirect(route('discount.manage.view'));
    }

    public function filterProductByShop(Request $request)
    {
        $shop_id = $request->shop_id;
        if ($shop_id != 0) {
            try {
                $products = Product::select('id', 'name')->where('shop_id', $shop_id)->get();
                return response()->json($products);
            } catch (\Exception $e) {
                return response()->json(null);
            }
        } else {
            return response()->json(null);
        }
    }

}
