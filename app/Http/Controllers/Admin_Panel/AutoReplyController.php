<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;

class AutoReplyController extends Controller
{
    public function viewCreateARForm()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $auto_reply_details = null;
        return view('admin_panel.bot.create_auto_reply')
            ->with("title", "Howkar Technology | Add Category")
            ->with("auto_reply_details", $auto_reply_details)
            ->with('shop_list', $shops);
    }

    public function getPagePosts(Request $request)
    {
        $page = Shop::select('page_access_token', 'page_id')->where('id', $request->shop_id)->first();

        $ch = curl_init('https://graph.facebook.com/v8.0/' . $page['page_id'] . '/feed?access_token=' . $page['page_access_token']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }
}
