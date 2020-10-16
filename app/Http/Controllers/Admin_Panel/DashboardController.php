<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
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
        return view('admin_panel.dashboard')->with('title', "Howkar Technology || Dashboard");
    }

    public function showHome()
    {
        return view('admin_panel.home')->with('title', "Howkar Technology");
    }

    public function showClientProfile()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view('admin_panel.profile.profile')
            ->with('title', "Howkar Technology || Profile")
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
            $user->save();

            for ($i = 0; $i < sizeof($request->pages); $i++) {
                $requested_pages = new RequestedPage();
                $requested_pages->page_id = $request->pages[$i];
                $requested_pages->user_id = $user->id;
                $requested_pages->save();
            }

            DB::commit();
            Session::flash('success_message', 'Your request has been submitted');
            return redirect(route('clients.profile'));
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
            return redirect(route('clients.profile'));
        }
    }
}
