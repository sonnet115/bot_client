<?php

namespace App\Http\Controllers\Admin_Panel;

use App\AutoReply;
use App\AutoReplyProduct;
use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AutoReplyController extends Controller
{
    public function viewCreateARForm()
    {
//        dd(AutoReply::with('auto_reply_products')->get());
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $auto_reply_details = null;
        return view('admin_panel.bot.create_auto_reply')
            ->with("title", "Howkar Technology || Create Auto Reply")
            ->with("auto_reply_details", $auto_reply_details)
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
}
