<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Billing;
use App\DeliveryCharge;
use App\Http\Controllers\Controller;
use App\PaymentInfo;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Array_;

class PageController extends Controller
{
    function storePagesForApproval(Request $request)
    {
        if ($request->facebook_api_response['authResponse'] == null) {
            return response()->json('cancelled');
        }

        $long_lived_user_access_token = $this->getLongLivedUserAccessToken($request->facebook_api_response['authResponse']['accessToken'])->access_token;
        $user_id = $request->facebook_api_response['authResponse']['userID'];
        $connection_status = $request->facebook_api_response['status'];
        $pages_details = json_decode($this->addPageToApp($long_lived_user_access_token, $user_id), true);
        $permissions_list = $request->facebook_api_response['authResponse']['grantedScopes'];
        $permission_list_array = explode(',', $permissions_list);

        if ($this->checkPermissions($permission_list_array) != '' && count($permission_list_array) > 2) {
            $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, false);
            $this->updatePageConnectionStatus($user_id, null, false);
            return response()->json($this->checkPermissions($permission_list_array));
        }

        if ($connection_status === 'connected') {
            //change all page connected status false
            $this->updatePageConnectionStatus($user_id, null, false);

            if (empty($pages_details['data'])) {
                //change all page connected status false if no page is selected
                $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, false);
                return response()->json('no_page_added');
            } else {
                //at least 1 page is selected
                for ($i = 0; $i < sizeof($pages_details['data']); $i++) {
                    $page_contact = null;
                    $page_address = null;
                    $page_username = null;
                    $page_web_link = null;

                    if (array_key_exists('phone', $pages_details['data'][$i])) {
                        $page_contact = $pages_details['data'][$i]['phone'];
                    }

                    if (array_key_exists('single_line_address', $pages_details['data'][$i])) {
                        $page_address = $pages_details['data'][$i]['single_line_address'];
                    }

                    if (array_key_exists('username', $pages_details['data'][$i])) {
                        $page_username = $pages_details['data'][$i]['username'];
                    }

                    if (array_key_exists('website', $pages_details['data'][$i])) {
                        $page_web_link = $pages_details['data'][$i]['website'];
                    }

                    $page = Shop::where('page_id', $pages_details['data'][$i]['id'])->first();

                    if (!$page) {
                        //page is not in our DB. So insert the page
                        $shop = Shop::create([
                            'page_name' => $pages_details['data'][$i]['name'],
                            'page_id' => $pages_details['data'][$i]['id'],
                            'page_access_token' => $pages_details['data'][$i]['access_token'],
                            'page_owner_id' => $user_id,
                            'page_contact' => $page_contact,
                            'page_likes' => $pages_details['data'][$i]['fan_count'],
                            'is_published' => $pages_details['data'][$i]['is_published'],
                            'page_subscription_status' => 1,
                            'is_webhooks_subscribed' => $pages_details['data'][$i]['is_webhooks_subscribed'],
                            'page_username' => $page_username,
                            'page_address' => $page_address,
                            'page_web_link' => $page_web_link,
                            'page_connected_status' => true,
                        ]);
                        $this->storeInitialDeliveryCharge($shop->id);
                    } else {
                        //page is already in database. So update page status
                        $this->updatePageConnectionStatus(null, $pages_details['data'][$i]['id'], true);
                    }

                }
                $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, true);
            }
            return response()->json('success');
        } else {
            return response()->json("failed");
        }
    }

    function storePages(Request $request)
    {
        if ($request->facebook_api_response['authResponse'] == null) {
            return response()->json('cancelled');
        }
        $long_lived_user_access_token = $this->getLongLivedUserAccessToken($request->facebook_api_response['authResponse']['accessToken'])->access_token;
        $user_id = $request->facebook_api_response['authResponse']['userID'];
        $connection_status = $request->facebook_api_response['status'];
        $pages_details = json_decode($this->addPageToApp($long_lived_user_access_token, $user_id), true);
        $permissions_list = $request->facebook_api_response['authResponse']['grantedScopes'];
        $permission_list_array = explode(',', $permissions_list);

        if ($this->checkPermissions($permission_list_array) != '' && count($permission_list_array) > 2) {
            $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, false);
            $this->updatePageConnectionStatus($user_id, null, false);
            return response()->json($this->checkPermissions($permission_list_array));
        }

        if ($connection_status === 'connected') {
            //change all page connected status false
            $this->updatePageConnectionStatus($user_id, null, false);

            if (empty($pages_details['data'])) {
                //change all page connected status false if no page is selected
                $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, false);
                return response()->json('no_page_added');
            } else {
                //at least 1 page is selected
                for ($i = 0; $i < sizeof($pages_details['data']); $i++) {
                    $page_contact = null;
                    $page_address = null;
                    $page_username = null;
                    $page_web_link = null;

                    if (array_key_exists('phone', $pages_details['data'][$i])) {
                        $page_contact = $pages_details['data'][$i]['phone'];
                    }

                    if (array_key_exists('single_line_address', $pages_details['data'][$i])) {
                        $page_address = $pages_details['data'][$i]['single_line_address'];
                    }

                    if (array_key_exists('username', $pages_details['data'][$i])) {
                        $page_username = $pages_details['data'][$i]['username'];
                    }

                    if (array_key_exists('website', $pages_details['data'][$i])) {
                        $page_web_link = $pages_details['data'][$i]['website'];
                    }

                    $page = Shop::where('page_id', $pages_details['data'][$i]['id'])->first();

                    if (!$page) {
                        //page is not in our DB. So insert the page
                        $shop = Shop::create([
                            'page_name' => $pages_details['data'][$i]['name'],
                            'page_id' => $pages_details['data'][$i]['id'],
                            'page_access_token' => $pages_details['data'][$i]['access_token'],
                            'page_owner_id' => $user_id,
                            'page_contact' => $page_contact,
                            'page_likes' => $pages_details['data'][$i]['fan_count'],
                            'is_published' => $pages_details['data'][$i]['is_published'],
                            'page_subscription_status' => 1,
                            'is_webhooks_subscribed' => $pages_details['data'][$i]['is_webhooks_subscribed'],
                            'page_username' => $page_username,
                            'page_address' => $page_address,
                            'page_web_link' => $page_web_link,
                            'page_connected_status' => true,
                        ]);
                        $this->storeInitialDeliveryCharge($shop->id);
                    } else {
                        //page is already in database. So update page status
                        $this->updatePageConnectionStatus(null, $pages_details['data'][$i]['id'], true);
                        $this->updatePageAccessToken($pages_details['data'][$i]['id'], $pages_details['data'][$i]['access_token']);
                    }
                    if ($this->checkSubscriptionStatus($pages_details['data'][$i]['id'])) {
                        $page_access_token = $pages_details['data'][$i]['access_token'];
                        $webhook_fields = json_decode($this->addFieldsToWebhook($page_access_token, $pages_details['data'][$i]['id']));
                        $persistent_menu = json_decode($this->addPersistentMenu($page_access_token));

                        Log::channel('page_connect')->info('persistent_menu [' . $pages_details['data'][$i]['id'] . ']:' . json_encode($persistent_menu));
                        Log::channel('page_connect')->info('webhook_fields [' . $pages_details['data'][$i]['id'] . ']:' . json_encode($webhook_fields) . PHP_EOL);
                    }
                }
                $this->updatePageAddedStatus($user_id, $long_lived_user_access_token, true);
            }
            return response()->json('success');
        } else {
            return response()->json("failed");
        }
    }

    function checkPermissions($permission_list_array)
    {
        if (!in_array('pages_show_list', $permission_list_array)) {
            return 'pages_show_list';
        }
        if (!in_array('pages_messaging', $permission_list_array)) {
            return 'pages_messaging';
        }
        if (!in_array('pages_manage_metadata', $permission_list_array)) {
            return 'pages_manage_metadata';
        }

        return '';
    }

    function checkSubscriptionStatus($page_id)
    {
        $status = Shop::where('page_id', $page_id)->where('page_subscription_status', '=', 1)->first();
        if ($status) {
            return true;
        } else {
            return false;
        }
    }

    function updatePageConnectionStatus($user_id, $page_id, $page_connection_status)
    {
        if ($user_id != null) {
            Shop::where('page_owner_id', $user_id)
                ->update(
                    [
                        'page_connected_status' => $page_connection_status,
                    ]);
        }

        if ($page_id != null) {
            Shop::where('page_id', $page_id)
                ->update(
                    [
                        'page_connected_status' => $page_connection_status,
                    ]);
        }
    }

    private function updatePageAccessToken($page_id, $page_access_token)
    {
        Shop::where('page_id', $page_id)
            ->update(
                [
                    'page_access_token' => $page_access_token,
                ]);
    }

    function updatePageAddedStatus($user_id, $user_access_token, $page_added_status)
    {
        User::where('user_id', $user_id)
            ->update(
                [
                    'long_lived_user_token' => $user_access_token,
                    'page_added' => $page_added_status
                ]);
    }

    function startTrailPeriod($page_id)
    {
        $start_date = date('Y-m-d'); // Y-m-d
        $end_date = date('Y-m-d', strtotime($start_date . ' + 10 days'));

        Billing::create([
            'page_id' => $page_id,
            'prev_billing_date' => $start_date,
            'next_billing_date' => $end_date,
            'paid_amount' => 0,
            'payable_amount' => $this->calculatePayableAmount($page_id),
            'status' => 0,
        ]);
    }

    function calculatePayableAmount($page_id)
    {
        return 2000;
    }

    function viewShopList()
    {
        return view("admin_panel.shop.shop_lists")->with("title", "Howkar Technology || Shops List");
    }

    function viewShopListApproval()
    {
        return view("admin_panel.shop.shops_approval")->with("title", "Howkar Technology || Shops Approval");
    }

    function viewBillingInfo()
    {
        return view("admin_panel.shop.billing_info")->with("title", "Howkar Technology || Shops List");
    }

    function getBillingInfo()
    {
        //return datatables(Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->with('billing'))->toJson();
        return datatables(array())->toJson();
    }

    function getShopsList()
    {
        return datatables(Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1))->toJson();
    }

    function storePaymentInfo(Request $request)
    {
        PaymentInfo::create($request->all());
        return response()->json('Success');
    }

    public function getLongLivedUserAccessToken($short_lived_user_access_token)
    {
        $ch = curl_init('https://graph.facebook.com/v3.2/oauth/access_token?grant_type=fb_exchange_token&client_id=967186797063633&client_secret=cf8809fcc502890072d63572b4d1f335&fb_exchange_token=' . $short_lived_user_access_token);
        //$ch = curl_init('https://graph.facebook.com/v3.2/oauth/access_token?grant_type=fb_exchange_token&client_id=1092841357718647&client_secret=13115cf1e8ea8b246b3eb74f05cd177a&fb_exchange_token=' . $short_lived_user_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = json_decode(curl_exec($ch));
        Log::channel('page_connect')->info('user long lived token' . json_encode(curl_exec($ch)));
        return $response;
    }

    public function addPageToApp($user_access_token, $user_id)
    {
        $ch = curl_init('https://graph.facebook.com/' . $user_id . '/accounts?fields=name,access_token,fan_count,is_published,is_webhooks_subscribed,single_line_address,username,website&access_token=' . $user_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        Log::channel('page_connect')->info('page_details' . json_encode($response) . PHP_EOL);
        return $response;
    }

    public function addFieldsToWebhook($page_access_token, $page_id)
    {
        $ch = curl_init('https://graph.facebook.com/v3.2/' . $page_id . '/subscribed_apps?subscribed_fields=messages,messaging_postbacks,messaging_optins,feed&access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }

    public function addGetStartedButton($page_access_token)
    {
        $request_body = '{
                            "get_started": {
                                "payload": "GET_STARTED"
                            }
                         }';

        $ch = curl_init('https://graph.facebook.com/v6.0/me/messenger_profile?access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }

    public function removePageFromBot()
    {
        $shops = Shop::where('page_owner_id', '=', auth()->user()->user_id)->where('page_connected_status', '=', 1)->get();
        //$this->removeWebhookFields($shops);
        $this->removePersistentAndGetStartedMenu($shops);
        return response()->json('success');
    }

    public function removePersistentAndGetStartedMenu($shops)
    {
        $request_body = '{
                            "fields": [
                                "persistent_menu",
                                "get_started"
                            ]
                        }';

        foreach ($shops as $shop) {
            $page_access_token = $shop['page_access_token'];
            $ch = curl_init('https://graph.facebook.com/v6.0/me/messenger_profile?access_token=' . $page_access_token);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            $response = curl_exec($ch);
            Log::channel('page_connect')->info('delete_persistent_menu [' . $shop['page_id'] . ']:' . json_encode($response));
        }
        return response()->json('success');
    }

    public function removeWebhookFields($shops)
    {
        foreach ($shops as $shop) {
            $page_access_token = $shop['page_access_token'];
            $ch = curl_init('https://graph.facebook.com/v3.2/' . $shop->page_id . '/subscribed_apps?access_token=967186797063633|FeDiwEGXFOBmsTInUre0HPLI1yY');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            $response = curl_exec($ch);
            Log::channel('page_connect')->info('delete_webhook_field [' . $shop['page_id'] . ']:' . json_encode($response));
        }
        return response()->json('success');
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
                                        {
                                            "type": "web_url",
                                            "title": "Powered By Howkar Technology",
                                            "url": "https://howkar.com/",
                                            "webview_height_ratio": "full"
                                        }
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
        return curl_exec($ch);
    }

    public function addWhiteListedDomains($page_access_token)
    {
        $request_body = '{
                            "whitelisted_domains": [
                                "' . env('WHITELIST_DOMAIN') . '"
                            ]
                        }';

        $ch = curl_init('https://graph.facebook.com/v6.0/me/messenger_profile?access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }

    public function storeInitialDeliveryCharge($page_id)
    {
        try {
            $dc = new DeliveryCharge();
            $dc->name = 'Inside Dhaka';
            $dc->delivery_charge = '60';
            $dc->shop_id = $page_id;
            $dc->save();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
