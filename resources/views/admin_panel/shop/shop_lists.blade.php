@extends("admin_panel.main")
@section("product-css")
    <style>
        .pagination {
            display: block !important;
        }
    </style>
@endsection

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Shop List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            <span class="font-18 connect_text text-primary"></span>
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="user_list_table" class="table table-bordered w-100 display">
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
                    <p class="text-center"><span class="text-warning"><i class="fa fa-exclamation-triangle"></i></span>
                        You have declined <span class="text-danger">'Show a list of the Pages you manage'</span>
                        permissions.
                        Our application needs this permission to work properly.
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-sm btn-success" onclick="connectDisconnectPage()">
                                <i class="fa fa-check-circle"></i> Give Permission
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("product-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-dt/js/dataTables.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.flash.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/jszip/dist/jszip.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/pdfmake.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/pdfmake/build/vfs_fonts.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.html5.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-buttons/js/buttons.print.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#user_list_table').DataTable({
                dom: 'frtip',
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
                            let color = row.page_connected_status === 1 ? "danger" : "success";
                            let text = row.page_connected_status === 1 ? "Disconnect" : "Connect";
                            return '<button style="min-width: 101px;border:1px solid" onclick="connectDisconnectPage()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-' + color + '">' + text + '</button>';
                        },
                    }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });
    </script>
@endsection

@section("shop-js")
    <script>
        function connectDisconnectPage() {
            // $("#message_modal").modal(
            //     {
            //         backdrop: 'static',
            //         keyboard: false,
            //         show: true
            //     }
            // );
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
                        // setTimeout(function () {
                        //     window.location.reload(true);
                        // }, 1000);
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
                return '<p class="text-center text-success font-15"><i class="fa fa-check"></i> Done</p>' +
                    '   <div class="row">\n' +
                    '       <div class="col-12 text-center">\n' +
                    '            <button class="btn btn-sm btn-success" data-dismiss="modal">\n' +
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
                return '<p class="text-center text-success"><i class="fa fa-times"></i> Could not complete your request. Please try again!</p>' +
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

@section("custom_css")
    <style>
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
+
