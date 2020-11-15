<?php

namespace App\Http\Controllers\Admin_Panel;

use App\AutoReply;
use App\AutoReplyProduct;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AutoReplyController extends Controller
{
    public function viewCreateARForm()
    {
        if (request()->get('mode')) {
            $arid = request()->get('arid');
            $auto_reply_details = AutoReply::where('id', $arid)->with('shop')->with('auto_reply_products')->first();

            if ($auto_reply_details->shop->page_connected_status != 1) {
                return redirect(route('auto.reply.list'));
            }

            if ($auto_reply_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('auto.reply.list'));
            }
            $products = Product::where('shop_id', $auto_reply_details->shop->id)->where('state', 1)->get();
        } else {
            $auto_reply_details = null;
            $products = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();


        return view('admin_panel.bot.create_auto_reply')
            ->with("title", "Howkar Technology || Create Auto Reply")
            ->with("auto_reply_details", $auto_reply_details)
            ->with("products", $products)
            ->with('shop_list', $shops);
    }

    public function getPagePosts(Request $request)
    {
        $page = Shop::select('page_access_token', 'page_id')->where('id', $request->shop_id)->first();

        $ch = curl_init('https://graph.facebook.com/v8.0/' . $page['page_id'] . '/posts?limit=10&access_token=' . $page['page_access_token']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }

    public function storeAR(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ar_name' => 'required',
            'shop_id' => 'required',
            'post_id' => 'required',
            'products_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $auto_reply = new AutoReply();
            $auto_reply->name = $request->ar_name;
            $auto_reply->post_id = $request->post_id;
            $auto_reply->shop_id = $request->shop_id;
            $auto_reply->save();


            for ($i = 0; $i < sizeof($request->products_id); $i++) {
                $auto_reply_products = new AutoReplyProduct();
                $auto_reply_products->pid = $request->products_id[$i];
                $auto_reply_products->ar_id = $auto_reply->id;
                $auto_reply_products->save();
            }

            Session::flash('success_message', 'Auto Reply Saved Successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('failed_message', 'Something went wrong. Try again!');
        }

        return redirect(route('auto.reply.create.view'));
    }

    public function viewARLists(AutoReply $autoReply)
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view("admin_panel.bot.auto_reply_lists")
            ->with("shops", $shops)
            ->with("title", "Howkar Technology || Auto Reply Lists");
    }

    public function getARLists(AutoReply $autoReply)
    {
        $autoReply = $autoReply->newQuery();

        if (request()->has('shop_id') && request('shop_id') != null) {
            $autoReply->where('shop_id', '=', request('shop_id'));
        }

        $shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get();

        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $autoReply->whereIn('shop_id', $shops_id);

        if (auth()->user()->page_added > 0) {
            return datatables($autoReply->orderBy('id', 'asc')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateAR(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ar_name' => 'required',
            'shop_id' => 'required',
            'products_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            AutoReplyProduct::where('ar_id', $request->auto_reply_id)->delete();

            $auto_reply = AutoReply::find($request->auto_reply_id);
            $auto_reply->name = $request->ar_name;
            $auto_reply->shop_id = $request->shop_id;
            $auto_reply->save();

            for ($i = 0; $i < sizeof($request->products_id); $i++) {
                $auto_reply_products = new AutoReplyProduct();
                $auto_reply_products->pid = $request->products_id[$i];
                $auto_reply_products->ar_id = $auto_reply->id;
                $auto_reply_products->save();
            }

            Session::flash('success_message', 'Auto Reply Updated Successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('failed_message', 'Something went wrong. Try again!');
        }

        return redirect(route('auto.reply.create.view'));
    }
}
