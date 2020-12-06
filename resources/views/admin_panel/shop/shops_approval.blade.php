<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{{$title}}</title>
    <meta name="description" content="Messenger Automation System"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}">
    <link rel="icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}" type="image/x-icon">

    <link href={{asset("assets/admin_panel/vendors/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet"
          type="text/css">

    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>

    <!-- Custom CSS -->
    <link href={{asset("assets/admin_panel/dist/css/style.css")}} rel="stylesheet" type="text/css">
    <link href={{asset("assets/admin_panel/dist/css/custom.css")}} rel="stylesheet" type="text/css">

    <style>
        .pagination {
            display: block !important;
        }

        #user_list_table_length {
            margin-right: 10px;
        }

        .dataTables_filter {
            margin-top: -10px;
        }

        .dataTables_filter label {
            text-align: left;
        }

        .hk-wrapper.hk-vertical-nav .hk-pg-wrapper {
            margin-left: 0 !important;
        }
    </style>
</head>

<body>
<!-- Preloader-->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);">
            <span class="feather-icon"><i data-feather="menu"></i></span>
        </a>
        <a class="navbar-brand font-weight-900 text-white" style="font-size: 30px !important;"
           href="#">Howkar Technology
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="{{auth()->user()->profile_picture}}" alt="user"
                                     class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{auth()->user()->name}}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="dropdown-icon zmdi zmdi-power"></i>
                        <span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /Top Navbar -->

    <!-- Main Content -->

    <!-- Container -->
    <div class="hk-pg-wrapper" style="margin-top: 35px">
        <div class="container mt-xl-20 mt-sm-30 mt-15">
            <!-- Product List starts -->
            <h4 class="hk-pg-title font-weight-700 mb-10 ">
                <i class="text-warning fa fa-warning"><span
                        class="text-muted"> Please Connect your page first</span></i>
            </h4>
            <div class="row">
                <div class="col-xl-12">
                    <section class="hk-sec-wrapper">
                        <div class="row">
                            <div class="col-sm">
                                <div class="float-left">
                                    <button class="btn btn-success btn-rounded" onclick="connectDisconnectPage()"><i
                                            class="fa fa-chain"></i> Connect Facebook Page
                                    </button>
                                </div>
                                @if(auth()->user()->page_added == 1)
                                    <div class="float-right">
                                        <a href="{{route('clients.profile')}}" class="btn btn-primary btn-rounded">
                                            Next <i class="font-18 fa fa-arrow-circle-o-right"></i>
                                        </a>
                                    </div>
                                @endif
                                <div style="clear: both"></div>
                                <hr>
                                <span class="font-18 connect_text text-primary"></span>
                                @if(Session::has('success_message'))
                                    <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                                @endif
                                <div class="table-wrap">
                                    <table id="shop_list_table" class="table table-bordered w-100 display">
                                        <thead class="btn-gradient-info">
                                        <tr>
                                            <th class="text-center text-white" data-priority="1">Page Name</th>
                                            <th class="text-center text-white">Page Likes</th>
                                            <th class="text-center text-white"> Connection Status</th>
                                            <th class="text-center text-white" data-priority="1">Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- /Row -->
        </div>
        <!-- Footer -->
        <div class="hk-footer-wrap container">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Developed by
                            <a href="https://howkar.com/" class="text-dark" target="_blank">Howkar Technology</a> ©
                            2020-2021
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="d-inline-block">Follow us</p>
                        <a href="https://www.facebook.com/howkar.bd/"
                           class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                                class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- /Container -->

    <!-- Modal -->
    <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center text-secondary">Page Management</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="message">

                </div>
            </div>
        </div>
    </div>

    {{--warning modal--}}
    <div class="modal fade" id="warning_modal" tabindex="-1" role="dialog" aria-labelledby="warning_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center text-secondary">Disconnect Page</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center text-danger">
                        <i class="fa fa-warning text-warning"></i> This will disconnect your page from our bot
                    </p>
                    <p class="font-21 text-center">Are you sure?</p>

                    <div id="remove_persistent_menu_message">
                        <div class="float-left">
                            <button class="btn btn-danger" id="confirm-disconnect">Confirm</button>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->
</div>
<!-- /HK Wrapper -->

<!-- jQuery -->
<script src={{asset("assets/admin_panel/vendors/jquery/dist/jquery.min.js")}}></script>

<!-- Bootstrap Core JavaScript -->
{{--<script src={{asset("assets/admin_panel/vendors/popper.js/dist/umd/popper.min.js")}}></script>--}}
<script src={{asset("assets/admin_panel/vendors/bootstrap/dist/js/bootstrap.min.js")}}></script>

<!-- FeatherIcons JavaScript -->
<script src={{asset("assets/admin_panel/dist/js/feather.min.js")}}></script>

{{--<!-- Init JavaScript -->--}}
<script src={{asset("assets/admin_panel/dist/js/init.js")}}></script>

@if (env('APP_ENV') == 'production')
    <script
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=967186797063633&autoLogAppEvents=1"
        nonce="AhbIxnz8" async defer crossorigin="anonymous">
    </script>
@else
    <script
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=1092841357718647&autoLogAppEvents=1"
        nonce="AhbIxnz8" async defer crossorigin="anonymous">
    </script>
@endif
<script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
<script
    src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
<script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

<!-- data table-->
<script>
    $(document).ready(function () {
        $('#shop_list_table').DataTable({
            dom: 'rtip',
            responsive: true,
            "language": {
                "processing": "Loading. Please wait..."
            },
            "bPaginate": true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('shop.list.get.approval') }}",
            },

            "columnDefs": [
                {
                    "className": "dt-center",
                    "targets": [1, 2, 3]
                }
            ],
            columns: [
                {data: 'page_name', name: 'page_name'},
                {data: 'page_likes', name: 'page_likes'},
                {
                    'render': function (data, type, row) {
                        let color = row.page_connected_status === 1 ? "success" : "danger";
                        let text = row.page_connected_status === 1 ? "Connected" : "Disconnected";
                        return '<span  style="min-width: 103px" class="badge badge-pill badge-' + color + ' pr-15 pl-15">' + text + '</span>';
                    },
                },
                {
                    'render': function (data, type, row) {
                        let btn = '';

                        if (row.page_connected_status === 1) {
                            btn = '<button style="min-width: 101px;border:1px solid" onclick="showConfirmation()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-danger">Disconnected</button>';
                        } else {
                            btn = '<button style="min-width: 101px;border:1px solid" onclick="connectDisconnectPage()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-success">Connected</button>';
                        }
                        return btn;
                    },
                }
            ],
            "drawCallback": function () {
                $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
            },
        });
    });

    $(document).ready(function () {
        $('#message_modal').on('hidden.bs.modal', function () {
            window.location.reload(true);
        });

        $("#confirm-disconnect").on("click", function () {
            let disconnect = '<div class="text-center">' +
                '<button class="btn btn-danger" id="disconnect_btn" onclick="connectDisconnectPage()">Disconnect Page</button>' +
                '</div>'
            $("#remove_persistent_menu_message").html(disconnect);
            /*$("#remove_persistent_menu_message").html('<p class="text-center text-green">Please wait ...</p>');
            $.ajax({
                type: "GET",
                url: "{{route('remove.pages.approval')}}",
                success: function (backend_response) {
                    let disconnect = '<div class="text-center">' +
                        '<button class="btn btn-danger" id="disconnect_btn" onclick="connectDisconnectPage()">Disconnect Page</button>' +
                        '</div>'
                    $("#remove_persistent_menu_message").html(disconnect);
                    console.log(backend_response);
                }
            });*/
        });
    });

    function showConfirmation() {
        $('#warning_modal').modal('toggle');
    }

    function connectDisconnectPage() {
        $('#warning_modal').modal('hide');
        FB.login(function (response) {
            console.log(response);
            $("#message_modal").modal(
                {
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                }
            );
            $("#message").html('<p class="text-center"><i class="fa fa-save"></i> Please Wait...</p>');

            $.ajax({
                type: "GET",
                url: "{{route('page.store.approval')}}",
                data: {
                    facebook_api_response: response
                },
                success: function (backend_response) {
                    $("#message").html(message(backend_response));
                    console.log(backend_response);
                }
            });
        }, {
            scope: 'pages_messaging, pages_manage_metadata, pages_show_list, pages_read_engagement',
            return_scopes: true
        });
    }

    function message(backend_response) {
        if (backend_response === 'success') {
            return '<p class="text-center text-success" style="font-size: 2rem"><i class="fa fa-check"></i> Completed</p>' +
                '   <hr>' +
                '   <div class="row">\n' +
                '       <div class="col-12 text-right">\n' +
                '            <button class="btn btn-sm btn-danger" data-dismiss="modal">\n' +
                '                     <i class="fa fa-check-circle"></i> Close\n' +
                '            </button>\n' +
                '       </div>\n' +
                '   </div>';
        } else if (backend_response === 'no_page_added') {
            return '  <p class="text-center text-danger"><i class="fa fa-times"></i> You have disconnected all your pages!\n' +
                '     </p>\n' +
                '     <hr>\n' +
                '     <div class="row">\n' +
                '          <div class="col-6 text-left">\n' +
                '               <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">Connect</button>\n' +
                '          </div>\n' +
                '          <div class="col-6 text-right">\n' +
                '               <button class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>\n' +
                '          </div>\n' +
                '     </div>';
        } else if (backend_response === 'pages_show_list') {
            return '<p class="text-center"><span class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>\n' +
                '                        You have declined <span class="text-danger">"Show a list of the Pages you manage"</span>\n' +
                '                        permissions.\n' +
                '                        Our application needs this permission to work properly.\n' +
                '  </p>\n' +
                '  <hr>\n' +
                '  <div class="row">\n' +
                '       <div class="col-12 text-center">\n' +
                '            <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">\n' +
                '                     <i class="fa fa-check-circle"></i> Give Permission\n' +
                '            </button>\n' +
                '       </div>\n' +
                '  </div>';
        } else if (backend_response === 'pages_messaging') {
            return '<p class="text-center"><span class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>\n' +
                '                        You have declined <span class="text-danger">"Manage and access Page conversations in Messenger"</span>\n' +
                '                        permissions.\n' +
                '                        Our application needs this permission to work properly.\n' +
                '  </p>\n' +
                '  <hr>\n' +
                '  <div class="row">\n' +
                '       <div class="col-12 text-center">\n' +
                '            <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">\n' +
                '                     <i class="fa fa-check-circle"></i> Give Permission\n' +
                '            </button>\n' +
                '       </div>\n' +
                '  </div>'
        } else if (backend_response === 'pages_manage_metadata') {
            return '<p class="text-center"><span class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>\n' +
                '                        You have declined <span class="text-danger">"Manage accounts, settings, and webhooks for a Page"</span>\n' +
                '                        permissions.\n' +
                '                        Our application needs this permission to work properly.\n' +
                '  </p>\n' +
                '  <hr>\n' +
                '  <div class="row">\n' +
                '       <div class="col-12 text-center">\n' +
                '            <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">\n' +
                '                     <i class="fa fa-check-circle"></i> Give Permission\n' +
                '            </button>\n' +
                '       </div>\n' +
                '  </div>'
        } else {
            return '<p class="text-center text-danger" style="margin-bottom: 15px"><i class="fa fa-times"></i> Could not complete your request. Please try again!</p>' +
                '     <div class="row">\n' +
                '          <div class="col-6 text-left">\n' +
                '               <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">Try Again</button>\n' +
                '          </div>\n' +
                '          <div class="col-6 text-right">\n' +
                '               <button class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>\n' +
                '          </div>\n' +
                '     </div>';
        }
    }
</script>

</body>
</html>
