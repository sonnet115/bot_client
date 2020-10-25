<?php

namespace App\Http\Controllers\Admin_Panel;

use App\DeliveryCharge;
use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeliveryChargeController extends Controller
{
    public function viewAddDeliveryChargeForm()
    {
        if (request()->get('mode')) {
            $dcid = request()->get('dcid');
            $dc_details = DeliveryCharge::where('id', $dcid)->with('shop')->first();

            if ($dc_details->shop->page_connected_status != 1) {
                return redirect(route('dc.list.view'));
            }

            if ($dc_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('dc.list.view'));
            }
        } else {
            $dc_details = null;
        }
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view("admin_panel.delivery_charges.add_dc_form")
            ->with("title", "Howkar Technology || Add Delivery Charge")
            ->with('dc_details', $dc_details)
            ->with('shop_list', $shops);
    }

    public function storeDeliveryCharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dc_name' => 'required',
            'dc_amount' => 'required|numeric',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $dc = new DeliveryCharge();
            $dc->name = $request->dc_name;
            $dc->delivery_charge = $request->dc_amount;
            $dc->shop_id = $request->shop_id;
            $dc->save();
            Session::flash('success_message', 'Delivery Charge Saved Successfully');
        } catch (\Exception $e) {
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }
        return redirect(route('dc.add.view'));
    }

    public function viewDeliveryChargeList()
    {
        return view("admin_panel.delivery_charges.dc_lists")->with("title", "Howkar Technology || DC Manage");
    }

    public function getDeliveryCharges(DeliveryCharge $deliveryCharge)
    {
        $deliveryCharge = $deliveryCharge->newQuery();

        $shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $deliveryCharge->whereIn('shop_id', $shops_id);

        if (auth()->user()->page_added > 0) {
            return datatables($deliveryCharge->orderBy('id', 'asc')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateDeliveryCharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dc_name' => 'required',
            'dc_amount' => 'required|numeric',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $dc = DeliveryCharge::find($request->dc_id);
            $dc->name = $request->dc_name;
            $dc->delivery_charge = $request->dc_amount;
            $dc->shop_id = $request->shop_id;
            $dc->save();
            Session::flash('success_message', 'Delivery Charge Updated Successfully');
        } catch (\Exception $e) {
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('dc.list.view'));
    }

}
