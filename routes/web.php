<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route for user login
Route::get("/", "Admin_Panel\DashboardController@showHome")->name('home')->middleware('authenticated.user');
Route::get('/auth/redirect/{provider}', 'Admin_Panel\UserController@redirect');
Route::get('/callback/{provider}', 'Admin_Panel\UserController@callback');
Route::get('logout', 'Admin_Panel\UserController@logout')->name('logout');

//Route for verification
Route::get("bot/verify-web-hook", "Bot\BotController@verifyWebhook")->middleware("verify");
//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("bot/verify-web-hook", "Bot\BotController@verifyWebhook");

Route::get("bot/{app_id}/test", "Bot\OrderController@getTestData");
Route::get("test", "Admin_Panel\DashboardController@getCategoryTree");

Route::group(['prefix' => 'bot/{app_id}'], function () {
    //Routes for place orders
    Route::get("cart/{customer_fb_id}", "Bot\OrderController@viewCheckoutForm")->name("cart.show");
    Route::get("get-cart-products", "Bot\OrderController@getCartProducts")->name("cart.get");
    Route::get("order-store", "Bot\OrderController@storeOrder")->name("order.store");
    Route::get("check-product", "Bot\OrderController@checkProductCode")->name("product.code.check");
    Route::get("check-qty", "Bot\OrderController@checkProductQty")->name("product.qty.check");

    //Routes for track orders
    Route::get("track-order-form/{id}", "Bot\OrderController@viewTrackOrderForm")->name("track.order.form");
    Route::get("get-order-status", "Bot\OrderController@getOrderStatus")->name("order.status.get");

    //Routes for pre orders
    Route::get("pre-order", "Bot\OrderController@storePreOrder")->name("pre-order.store");

    //Routes for add to cart
    Route::get("add-to-cart", "Bot\OrderController@addToCart")->name("add.cart");
    Route::get("remove-cart-product", "Bot\OrderController@removeCartProducts")->name("remove.cart");

    //Route for product enquiry
    Route::get("product-search-form/{id}", "Bot\ProductController@viewProductSearchForm")->name("product.search.form");
    Route::get("get-product", "Bot\ProductController@getProduct")->name("product.get");
});

Route::group(['middleware' => 'page.not.added'], function () {
    Route::group(['prefix' => 'admin'], function () {
        //Routes for shops & billing
        Route::group(['prefix' => 'shop-approval'], function () {
            Route::get("store-page", "Admin_Panel\PageController@storePagesForApproval")->name('page.store.approval');
            Route::get("shop-list", "Admin_Panel\PageController@viewShopListApproval")->name('shop.list.view.approval');
            Route::get("get-list", "Admin_Panel\PageController@getShopsList")->name('shop.list.get.approval');
            Route::get("remove-pages", "Admin_Panel\PageController@removePageFromBot")->name('remove.pages.approval');
        });
    });
});

Route::group(['middleware' => 'profile.not.completed'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get("client-profile", "Admin_Panel\DashboardController@showClientProfile")->name("clients.profile");
        Route::post("submit-for-approval", "Admin_Panel\DashboardController@submitForApproval")->name("submit.for.approval");
    });
});

Route::group(['middleware' => 'unauthenticated.user'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get("dashboard", "Admin_Panel\DashboardController@showDashboard")->name("dashboard");

        //Routes for Category
        Route::group(['prefix' => 'category'], function () {
            Route::get("add-form", "Admin_Panel\CategoryController@viewAddCategoryForm")->name("category.add.view");
            Route::post("store-category", "Admin_Panel\CategoryController@storeCategory")->name("category.store");
            Route::get("manage-form", "Admin_Panel\CategoryController@viewUpdateCategory")->name("category.manage.view");
            Route::post("update-category", "Admin_Panel\CategoryController@updateCategory")->name("category.update");
            Route::get("get-category", "Admin_Panel\CategoryController@getCategory")->name("category.get");
        });

        //Routes for Variant
        Route::group(['prefix' => 'variant'], function () {
            Route::get("add-form", "Admin_Panel\VariantController@viewAddVariantForm")->name("variant.add.view");
            Route::post("store-variant", "Admin_Panel\VariantController@storeVariant")->name("variant.store");
            Route::get("manage-form", "Admin_Panel\VariantController@variantLists")->name("variant.manage.view");
            Route::post("update-variant", "Admin_Panel\VariantController@updateVariant")->name("variant.update");
            Route::get("get-variant", "Admin_Panel\VariantController@getVariant")->name("variant.get");
        });

        //Routes for Products
        Route::group(['prefix' => 'product'], function () {
            Route::get("add-form", "Admin_Panel\ProductController@viewAddNewProductForm")->name("new.product.add.view");
            Route::get("add/new", "Admin_Panel\ProductController@viewAddNewProductForm")->name("new.product.add.view");
            Route::get("add/variation", "Admin_Panel\ProductController@viewAddProductVariantForm")->name("variation.product.add.view");
            Route::post("store-product", "Admin_Panel\ProductController@storeProduct")->name("product.store");
            Route::get("manage-form", "Admin_Panel\ProductController@viewUpdateProduct")->name("product.manage.view");
            Route::post("update-product", "Admin_Panel\ProductController@updateProduct")->name("product.update");
            Route::get("get-products", "Admin_Panel\ProductController@getProduct")->name("product.get");
            Route::post("get-category", "Admin_Panel\ProductController@getShopCategory")->name("get.shop.category");
            Route::post("get-product-details", "Admin_Panel\ProductController@getProductDetails")->name("get.product.details");
        });

        //Routes for Users
        Route::group(['prefix' => 'user'], function () {
            Route::get("add-form", "Admin_Panel\UserController@viewAddUserForm")->name("user.add.view");
            Route::post("store-user", "Admin_Panel\UserController@storeUser")->name("user.store");
            Route::get("manage-form", "Admin_Panel\UserController@viewUpdateUser")->name("user.manage.view");
            Route::get("get-user", "Admin_Panel\UserController@getUser")->name("user.get");
        });

        //Routes for discount
        Route::group(['prefix' => 'discount'], function () {
            Route::get("add-form", "Admin_Panel\DiscountController@viewAddDiscountForm")->name("discount.add.view");
            Route::get("get-product-shop", "Admin_Panel\DiscountController@filterProductByShop")->name("get.shop.product");
            Route::post("store-discount", "Admin_Panel\DiscountController@storeDiscount")->name("discount.store");
            Route::get("manage-form", "Admin_Panel\DiscountController@viewUpdateDiscount")->name("discount.manage.view");
            Route::post("update-discount", "Admin_Panel\DiscountController@updateDiscount")->name("discount.update");
            Route::get("get-discount", "Admin_Panel\DiscountController@getDiscount")->name("discount.get");
        });

        //Routes for order
        Route::group(['prefix' => 'order'], function () {
            Route::get("manage-form", "Admin_Panel\OrderController@viewManageOrder")->name("order.manage.view");
            //Route::post("update-discount", "Admin_Panel\DiscountController@updateDiscount")->name("discount.update");
            Route::get("get-order", "Admin_Panel\OrderController@getOrders")->name("order.get");
            Route::get("get-order-details", "Admin_Panel\OrderController@getOrdersDetails")->name("order.details.get");
            Route::get("get-order-status", "Admin_Panel\OrderController@getProductStatus")->name("order.status.get");
            Route::get("change-order-status", "Admin_Panel\OrderController@changeOrderStatus")->name("order.status.change");
            Route::get("get-ordered-products-view", "Admin_Panel\OrderController@getOrderedProductsView")->name("ordered.products.view");
            Route::get("get-ordered-products", "Admin_Panel\OrderController@getOrderedProducts")->name("ordered.products.get");
        });

        //Routes for delivery charges
        Route::group(['prefix' => 'delivery-charge'], function () {
            Route::get("add-form", "Admin_Panel\DeliveryChargeController@viewAddDeliveryChargeForm")->name("dc.add.view");
            Route::post("store-dc", "Admin_Panel\DeliveryChargeController@storeDeliveryCharge")->name('dc.store');
            Route::get("dc-list", "Admin_Panel\DeliveryChargeController@viewDeliveryChargeList")->name('dc.list.view');
            Route::post("update-dc", "Admin_Panel\DeliveryChargeController@updateDeliveryCharge")->name('dc.update');
            Route::get("get-dc", "Admin_Panel\DeliveryChargeController@getDeliveryCharges")->name('dc.get');
        });

        //Routes for Bot
        Route::group(['prefix' => 'bot'], function () {
            Route::get("create-auto-reply-form", "Admin_Panel\AutoReplyController@viewCreateARForm")->name("auto.reply.create.view");
            Route::post("get-page-posts", "Admin_Panel\AutoReplyController@getPagePosts")->name("get.page.posts");
            Route::post("store-auto-reply", "Admin_Panel\AutoReplyController@storeAR")->name("auto.reply.store");
            Route::post("update-auto-reply", "Admin_Panel\AutoReplyController@updateAR")->name("auto.reply.update");
            Route::get("auto-reply-list", "Admin_Panel\AutoReplyController@viewARLists")->name("auto.reply.list");
            Route::get("get-auto-reply-list", "Admin_Panel\AutoReplyController@getARLists")->name("auto.reply.get");

            Route::get("add-bot-products-form", "Admin_Panel\ProductController@viewAddBotProducts")->name("bot.products.add.view");
            Route::get("get-bot-products", "Admin_Panel\ProductController@getBotProducts")->name("get.bot.products");
            Route::post("update-bot-products", "Admin_Panel\ProductController@updateBotProducts")->name("bot.products.update");
        });

        //Routes for shops & billing
        Route::group(['prefix' => 'shop-billing'], function () {
            Route::get("store-page", "Admin_Panel\PageController@storePages")->name('page.store');
            Route::get("shop-list", "Admin_Panel\PageController@viewShopList")->name('shop.list.view');
            Route::get("get-list", "Admin_Panel\PageController@getShopsList")->name('shop.list.get');
            Route::get("remove-pages", "Admin_Panel\PageController@removePageFromBot")->name('remove.pages');
        });

        Route::group(['prefix' => 'shop-billing'], function () {
            Route::get("billing-info", "Admin_Panel\PageController@viewBillingInfo")->name('billing.info');
            Route::post("get-billing-info", "Admin_Panel\PageController@getBillingInfo")->name('billing.info.get');
            Route::post("store-payment-info", "Admin_Panel\PageController@storePaymentInfo")->name('payment.info.store');
        });

    });

});
