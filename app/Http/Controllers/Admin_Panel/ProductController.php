<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductVariant;
use App\Shop;
use App\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $shops;

    public function viewAddNewProductForm()
    {
        DB::enableQueryLog();
        $dd = Product::where('parent_product_id', '=', null)->with(['variants' => function ($query) {
            $query->groupBy('variant_id', 'product_id');
        }])->with('childProducts')->get();

        $ch = Product::with('childProducts')->get();
        $query = DB::getQueryLog();

//        dd($dd);

        if (request()->get('mode')) {
            $pid = request()->get('pid');
            $product_details = Product::where('id', $pid)->with('images')->with('shop')->first();
            if ($product_details->shop->page_connected_status != 1) {
                return redirect(route('product.manage.view'));
            }

            if ($product_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('product.manage.view'));
            }

        } else {
            $product_details = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();

        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $categories = Category::whereIn('shop_id', $shops_id)->get();

        $variant = Variant::where('user_id', auth()->user()->id)->with('variantProperties')->orderBy('id')->get();

        return view('admin_panel.product.add_product_form')
            ->with("title", "Howkar Technology | Add Product")
            ->with('product_details', $product_details)
            ->with('categories', $categories)
            ->with('variants', $variant)
            ->with('shop_list', $shops);
    }

    public function viewAddProductVariantForm()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }

        if (request()->get('mode')) {
            $pid = request()->get('pid');
            $product_details = Product::where('id', $pid)->with('images')->with('shop')->first();
            if ($product_details->shop->page_connected_status != 1) {
                return redirect(route('product.manage.view'));
            }

            if ($product_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('product.manage.view'));
            }
            $products = null;

        } else {
            $products = Product::whereIn('shop_id', $shops_id)->where('parent_product_id', null)->with('shop')->get();
            $product_details = null;
        }

        $categories = Category::whereIn('shop_id', $shops_id)->get();

        $variant = Variant::where('user_id', auth()->user()->id)->with('variantProperties')->orderBy('id')->get();

        return view('admin_panel.product.add_product_variant_form')
            ->with("title", "Howkar Technology | Add Product Variant")
            ->with('product_details', $product_details)
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('variants', $variant)
            ->with('shop_list', $shops);
    }

    public function getProductDetails()
    {
        $pid = request()->get('pid');
        $product_details = Product::where('id', $pid)->with('images')->with('shop')->with('category')->first();
        return response()->json($product_details);
    }

    public function storeProductBk(Request $request)
    {
        //product validation
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:30',
            'product_code' => 'required|unique:products,code|max:15',
            'product_stock' => 'required|integer|max:100000',
            'product_uom' => 'required|string|max:10',
            'product_price' => 'required|numeric|between:0,500000',
            'shop_id_name' => 'required',
            'category_ids' => 'required',
            'product_image_1' => 'required|file|max:1024',
            'product_image_1.*' => 'mimes:jpeg,png,jpg',
            'product_image_2' => 'file|max:1024',
            'product_image_2.*' => 'mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $shop_name = str_replace(' ', '_', explode('_', $request->shop_id_name)[1]);
            //product save
            $product = new Product();
            $product->name = $request->product_name;
            $product->code = $request->product_code;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->category_id = $request->category_ids;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->save();
            $product_id = $product->id;

            //product image save
            $this->storeProductImage($request, $product_id, 'product_image_1', 1, $shop_name);
            $this->storeProductImage($request, $product_id, 'product_image_2', 2, $shop_name);

            DB::commit();
            Session::flash('success_message', 'Product Saved Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('product.add.view'));
    }

    public function storeProduct(Request $request)
    {
        //dd($request->all());

        //product validation
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:30',
            'product_code' => 'required|unique:products,code|max:15',
            'product_stock' => 'required|integer|max:100000',
            'product_uom' => 'required|string|max:10',
            'product_price' => 'required|numeric|between:0,500000',
            'shop_id_name' => 'required',
            'category_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $variants = Variant::select('id')->where('user_id', auth()->user()->id)->get();
        $variant_ids = array();

        foreach ($variants as $variant) {
            $selected_variant_property = $request->input($variant->id);

            if ($selected_variant_property != '') {
                array_push($variant_ids, $selected_variant_property);
            }
        }
        $variant_combination_ids = implode('_', $variant_ids);


        DB::beginTransaction();
        try {
            $shop_name = str_replace(' ', '_', explode('_', $request->shop_id_name)[1]);
            $product = new Product();
            $product->name = $request->product_name;
            $product->code = $request->product_code;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->category_id = $request->category_ids;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->save();
            $product_id = $product->id;

            foreach ($variants as $variant) {
                $selected_variant_property = $request->input($variant->id);
                if ($selected_variant_property != '') {
                    $products_variants = new ProductVariant();
                    $products_variants->variant_id = $variant->id;
                    $products_variants->variant_property_ids = $selected_variant_property;
                    $products_variants->product_id = $product_id;
                    $products_variants->save();
                }
            }

            $parent_product_id = null;
            $product = new Product();
            $product->name = $request->product_name;
            $product->code = $request->product_code;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->category_id = $request->category_ids;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->variant_combination_ids = $variant_combination_ids;
            $product->parent_product_id = $product_id;
            $product->save();
            $product_id = $product->id;

            foreach ($variants as $variant) {
                $selected_variant_property = $request->input($variant->id);
                if ($selected_variant_property != '') {
                    $products_variants = new ProductVariant();
                    $products_variants->variant_id = $variant->id;
                    $products_variants->variant_property_ids = $selected_variant_property;
                    $products_variants->product_id = $product_id;
                    $products_variants->save();
                }
            }

            DB::commit();
            Session::flash('success_message', 'Product Saved Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
            dd($e);
        }

        return redirect(route('product.add.view'));
    }

    public function viewUpdateProduct()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $categories = Category::whereIn('shop_id', $shops_id)->get();

        return view("admin_panel.product.manage_product")
            ->with('shops', $shops)
            ->with('categories', $categories)
            ->with("title", "Howkar Technology || Manage Product");
    }

    public function getProduct(Product $product)
    {
        $product = $product->newQuery();

        if (request()->has('stock_from') && request()->has('stock_to') && request('stock_from') != null
            && request('stock_to') != null) {
            $product->where('stock', '>=', request('stock_from'))
                ->where('stock', '<=', request('stock_to'));
        }

        if (request()->has('status') && request('status') != null) {
            $product->where('state', '=', request('status'));
        }

        if (request()->has('shop_id') && request('shop_id') != null) {
            $product->where('shop_id', '=', request('shop_id'));
        }

        if (request()->has('category_id') && request('category_id') != null) {
            $product->where('category_id', '=', request('category_id'));
        }

        $this->shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get();
        $shops_id = array();
        foreach ($this->shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $product->whereIn('shop_id', $shops_id);

        if (auth()->user()->page_added > 0) {
            return datatables($product->orderBy('id', 'asc')->with("images")->with('shop')->with('category'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateProduct(Request $request)
    {
        $rules = array(
            'product_name' => 'required|max:30',
            'product_stock' => 'required|integer|max:100000',
            'product_uom' => 'required|string|max:10',
            'product_price' => 'required|numeric|between:0,500000',
            'shop_id_name' => 'required',
            'category_ids' => 'required',
            'product_image_1' => 'file|max:1024',
            'product_image_1.*' => 'mimes:jpeg,png,jpg',
            'product_image_2' => 'file|max:1024',
            'product_image_2.*' => 'mimes:jpeg,png,jpg',
        );
        if ($request->product_code !== $request->old_product_code) {
            $rules['product_code'] = 'required|unique:products,code|max:15';
        } else {
            $rules['product_code'] = 'required|max:15';
        }
        //product validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $shop_name = str_replace(' ', '_', explode('_', $request->shop_id_name)[1]);
            //product save
            $product = Product::find($request->product_id);
            $product->code = $request->product_code;
            $product->name = $request->product_name;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->state = $request->product_state;
            $product->category_id = $request->category_ids;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->save();

            //product image save
            if ($request->hasfile('product_image_1')) {
                $this->updateProductImage($request, 'product_image_1', 1, $shop_name);
            }
            if ($request->hasfile('product_image_2')) {
                $this->updateProductImage($request, 'product_image_2', 2, $shop_name);
            }

            DB::commit();
            Session::flash('success_message', 'Product Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('product.manage.view'));
    }

    public function storeProductImage($request, $product_id, $image, $image_no, $shop_name)
    {
        if ($request->hasfile($image)) {
            $file = $request->file($image);
            $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
            $file->move(public_path() . '/images/products/' . $shop_name . '/', $image_name);

            $productImage = new ProductImage();
            $productImage->pid = $product_id;
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        }
    }

    public function updateProductImage($request, $image, $image_no, $shop_name)
    {
        $file = $request->file($image);
        $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
        $file->move(public_path() . '/images/products/' . $shop_name . '/', $image_name);

        $image_id = 0;
        if ($image_no === 1) {
            $image_id = $request->image_1_id;
        } else {
            $image_id = $request->image_2_id;
        }

        $productImage = ProductImage::where('id', $image_id)->first();
        if ($productImage) {
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        } else {
            $productImage = new ProductImage();
            $productImage->pid = $request->product_id;
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        }
    }

    public function viewAddBotProducts()
    {
        $bot_products = null;
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view('admin_panel.bot.add_bot_product')
            ->with("title", "Howkar Technology || Add Bot Product")
            ->with('shop_list', $shops)
            ->with('bot_products', $bot_products);
    }

    public function getBotProducts(Request $request)
    {
        $shop_id = $request->shop_id;
        if ($shop_id != 0) {
            try {
                $products = Product::select('id', 'name', 'show_in_bot')->where('shop_id', $shop_id)->get();
                return response()->json($products);
            } catch (\Exception $e) {
                return response()->json(null);
            }
        } else {
            return response()->json(null);
        }
    }

    public function updateBotProducts(Request $request)
    {
        DB::beginTransaction();
        try {
            $products = Product::where('shop_id', $request->shop_id)->where('show_in_bot', 1)->get();

            if (count($products) == 0) {//no product added yet. so we add webhook and webhook fields
                $shop = Shop::find($request->shop_id);

                $this->addFieldsToWebhook($shop->page_access_token, $shop->page_id);
                $this->addPersistentMenu($shop->page_access_token);
            }

            Product::where('shop_id', $request->shop_id)
                ->update(['show_in_bot' => 0]);

            Product::whereIn('id', $request->products_id)
                ->update(['show_in_bot' => 1]);
            Session::flash('success_message', 'Messenger Bot Products Updated Successfully');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('failed_message', 'Something went wrong. Try again!');
        }

        return redirect(route('bot.products.add.view'));
    }

    public function getShopCategory(Request $request)
    {
        $shop_id = $request->shop_id;

        if ($shop_id != 0) {
            try {
                $products = Category::select('id', 'name')->where('shop_id', $shop_id)->get();
                return response()->json($products);
            } catch (\Exception $e) {
                return response()->json(null);
            }
        } else {
            return response()->json(null);
        }
    }

    public function addFieldsToWebhook($page_access_token, $page_id)
    {
        $ch = curl_init('https://graph.facebook.com/v3.2/' . $page_id . '/subscribed_apps?subscribed_fields=messages,messaging_postbacks,messaging_optins,feed&access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        Log::channel('page_connect')->info('add_webhook [' . $page_id . ']:' . json_encode($response));
        return $response;
    }

    public function addPersistentMenu($page_access_token)
    {
        $request_body = '{
                            "whitelisted_domains": [
                                 "' . env('WHITELIST_DOMAIN') . '"
                            ],
                            "get_started": {
                                "payload": "GET_STARTED"
                            },
                            "persistent_menu": [
                                {
                                    "locale": "default",
                                    "composer_input_disabled": false,
                                    "call_to_actions": [
                                        {
                                            "type": "postback",
                                            "title": "Products",
                                            "payload": "PRODUCT_SEARCH"
                                        },
                                        {
                                            "type": "postback",
                                            "title": "View Cart",
                                            "payload": "VIEW_CART"
                                        },
                                        {
                                            "type": "postback",
                                            "title": "Track Orders",
                                            "payload": "TRACK_ORDER"
                                        },
                                        {
                                            "type": "postback",
                                            "title": "Help",
                                            "payload": "TALK_TO_AGENT"
                                        },
                                    ]
                                }
                            ]
                        }';

        $ch = curl_init('https://graph.facebook.com/v8.0/me/messenger_profile?access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        Log::channel('page_connect')->info('add_persistent_menu :' . json_encode($response));
        return $response;
    }
}
