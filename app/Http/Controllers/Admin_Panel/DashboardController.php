<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Category;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\RequestedPage;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $total_pages = Shop::where('page_owner_id', auth()->user()->user_id)->count();

        $shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $total_products = Product::whereIn('shop_id', $shops_id)->count();
        $total_orders = Order::whereIn('shop_id', $shops_id)->count();
        $total_pending = Order::whereIn('shop_id', $shops_id)->where('order_status', '=', 0)->count();
        $total_delivered = Order::whereIn('shop_id', $shops_id)->where('order_status', '=', 3)->count();
        $total_cancelled = Order::whereIn('shop_id', $shops_id)->where('order_status', '=', 4)->count();

        $shops = Shop::select('page_id')->where('page_owner_id', auth()->user()->user_id)->get();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['page_id']);
        }
        $total_customers = Customer::whereIn('app_id', $shops_id)->count();

        $total_counts = array(
            'total_pages' => $total_pages,
            'total_products' => $total_products,
            'total_orders' => $total_orders,
            'total_customers' => $total_customers,
            'total_pending' => $total_pending,
            'total_delivered' => $total_delivered,
            'total_cancelled' => $total_cancelled,
        );

        return view('admin_panel.dashboard')
            ->with('title', "Howkar Technology || Dashboard")
            ->with('total_counts', $total_counts);
    }

    public function showHome()
    {
        return view('admin_panel.home')->with('title', "Howkar Technology");
    }

    public function showClientProfile()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view('admin_panel.profile.profile')
            ->with('title', "Howkar Technology || Approval")
            ->with('shop_list', $shops);
    }

    public function submitForApproval(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required',
            'email' => 'required',
            'pages' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);
            $user->contact = $request->contact;
            $user->email = $request->email;
            $user->profile_completed = 1;
            $user->save();

            RequestedPage::where('user_id', '=', $user->id)->delete();

            for ($i = 0; $i < sizeof($request->pages); $i++) {
                $requested_pages = new RequestedPage();
                $requested_pages->page_id = $request->pages[$i];
                $requested_pages->user_id = $user->id;
                $requested_pages->save();
            }

            DB::commit();
            Session::flash('success_message', 'We have received your request. We will notify you within 1 hour');
            return redirect(route('clients.profile'));
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
            return redirect(route('clients.profile'));
        }
    }

    function getTestData()
    {
        $categories = Category::where("parent_id", NULL)->with("subCategory")->get();
        $this->printCat($categories);
    }

    function printCat($categories)
    {
        /*foreach ($categories as $cat) {
            echo $cat->name . '<br>';
            if (count($cat->subCategory) > 0) {
                echo '<br>';
                $this->printCat($cat->subCategory);
            }
        }*/
        echo $this->getCategoryTree();
    }

    protected function getCategoryTree($level = NULL, $prefix = '') {
        $rows = Category::where("parent_id", $level)->with("subCategory")->get();

        $category = '';
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $category .= $prefix . $row->name . "\n";
                // Append subcategories
                $category .= $this->getCategoryTree($row->id, $prefix . '-');
            }
        }
        return $category;
    }

    public function printCategoryTree() {
        echo $this->getCategoryTree();
    }
}
