<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Variant;
use App\VariantProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    public function viewAddVariantForm()
    {
        return view('admin_panel.variant.add_variant')
            ->with("title", "Howkar Technology | Add Variant");
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
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
