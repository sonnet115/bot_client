<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Variant;
use App\VariantProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VariantController extends Controller
{
    public function viewAddVariantForm()
    {
        if (request()->get('mode')) {
            $vid = request()->get('vid');
            $variant_details = Variant::where('id', $vid)->with('variantProperties')->first();
            //dd($variant_details->variantProperties);
            if (auth()->user()->page_added <= 0) {
                return redirect(route('variant.manage.view'));
            }

            if ($variant_details->user_id !== auth()->user()->id) {
                return redirect(route('variant.manage.view'));
            }
        } else {
            $variant_details = null;
        }

        return view('admin_panel.variant.add_variant')
            ->with("title", "Howkar Technology | Add Variant")
            ->with('variant_details', $variant_details);
    }

    public function storeVariant(Request $request)
    {
        $variant_name = $request->variant_name;
        $user_id = Auth::user()->id;
        $properties = $request->prop_name;
        $desc = $request->prop_desc;


        DB::beginTransaction();
        try {
            $variant = Variant::create([
                'name' => $variant_name,
                'user_id' => $user_id
            ]);

            for ($i = 0; $i < sizeof($properties); $i++) {
                VariantProperty::create([
                    'vid' => $variant->id,
                    'property_name' => $properties[$i],
                    'description' => $desc[$i],
                ]);
            }

            DB::commit();
            Session::flash('success_message', 'Variant Saved Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('failed_message', 'Something went wrong. Try again!');
        }
        return redirect(route('variant.add.view'));
    }

    public function variantLists()
    {
        return view('admin_panel.variant.variant_lists')
            ->with("title", "Howkar Technology | Variant Lists");
    }

    public function getVariant()
    {
        if (auth()->user()->page_added > 0) {
            return datatables(Variant::where('user_id', auth()->user()->id)->with('variantProperties')->orderBy('id'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateVariant(Request $request)
    {
        $variant_name = $request->variant_name;
        $variant_id = $request->variant_id;
        $properties = $request->prop_name;
        $desc = $request->prop_desc;

        DB::beginTransaction();
        try {
            $variant = Variant::find($variant_id);
            $variant->name = $variant_name;
            $variant->save();

            VariantProperty::where('vid', $variant_id)->delete();

            for ($i = 0; $i < sizeof($properties); $i++) {
                VariantProperty::create([
                    'vid' => $variant->id,
                    'property_name' => $properties[$i],
                    'description' => $desc[$i],
                ]);
            }

            DB::commit();
            Session::flash('success_message', 'Variant Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('failed_message', 'Something went wrong. Try again!');
        }
        return redirect(route('variant.manage.view'));
    }
}
