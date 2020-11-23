@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Pages
                List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            <div class="text-center">
                                <button class="btn btn-success btn-rounded" onclick="connectDisconnectPage()"><i
                                        class="fa fa-facebook"></i> Connect Facebook Page
                                </button>
                            </div>
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
                        <i class="fa fa-warning text-warning"></i> This will disconnect your page from out bot
                    </p>
                    <p class="font-21 text-center">Are you sure?</p>
                    <hr>
                    <div id="remove_persistent_menu_message">
                        <div class="float-left">
                            <button class="btn btn-danger btn-sm" id="confirm-disconnect">Confirm</button>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("shop-list-css")
    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>
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
    </style>
@endsection

@section("shop-list-js")
   {{-- <script
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=967186797063633&autoLogAppEvents=1"
        nonce="AhbIxnz8" async defer crossorigin="anonymous">
    </script>--}}
    <script
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=1092841357718647&autoLogAppEvents=1"
        nonce="AhbIxnz8" async defer crossorigin="anonymous">
    </script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    {{--    <script src={{asset("assets/admin_panel/vendors/datatables.net-dt/js/dataTables.dataTables.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")}}></script>--}}
    {{--    <script--}}
    {{--        src={{asset("assets/admin_panel/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.flash.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/jszip/dist/jszip.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/pdfmake.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/vfs_fonts.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.html5.min.js")}}></script>--}}
    {{--    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.print.min.js")}}></script>--}}
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
                    url: "{{ route('shop.list.get') }}",
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
                                btn = '<button style="min-width: 101px;border:1px solid" onclick="showConfirmation()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-danger">Disconnect</button>';
                            } else {
                                btn = '<button style="min-width: 101px;border:1px solid" onclick="connectDisconnectPage()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-success">Connect</button>';
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
                $("#remove_persistent_menu_message").html('<p class="text-center text-green">Please wait ...</p>');
                $.ajax({
                    type: "GET",
                    url: "{{route('remove.pages')}}",
                    success: function (backend_response) {
                        let disconnect = '<div class="text-center">' +
                            '<button class="btn btn-danger" id="disconnect_btn" onclick="connectDisconnectPage()">Disconnect Page</button>' +
                            '</div>'
                        $("#remove_persistent_menu_message").html(disconnect);
                        console.log(backend_response);
                    }
                });
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
                    url: "{{route('page.store')}}",
                    data: {
                        facebook_api_response: response
                    },
                    success: function (backend_response) {
                        $("#message").html(message(backend_response));
                        console.log(backend_response);
                    }
                });
            }, {
                scope: 'pages_messaging, pages_manage_metadata, pages_show_list',
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
                return '<p class="text-center text-danger"><i class="fa fa-times"></i> Could not complete your request. Please try again!</p>' +
                    '  <hr>\n' +
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
@endsection
