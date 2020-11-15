@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-50 mt-lg-15">
        <!-- filter starts-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-filter">&nbsp;Filter
                Auto Reply</i>
        </h4>
        <div class="d-flex flex-wrap">
            <!-- shop starts-->
            <div class="form-group pl-2">
                <select class="form-control" name="shop_id">
                    <option value="" selected>Select a shop</option>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->page_name}}</option>
                    @endforeach
                </select>
            </div>
            <!--state ends-->

            <!--button-->
            <div class="text-left pl-4">
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-primary"><i
                        class="fa fa-filter">&nbsp;</i>Filter
                </button>
            </div>
            <!--button ends-->
        </div>
        <!-- filter ends-->

        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Auto Reply
                List</i>
        </h4>

        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">
                                    <i class="fa fa-check-circle"></i> {{ Session::get('success_message') }}
                                </p>
                            @endif
                            @if(Session::has('failed_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-danger') }}">
                                    <i class="fa fa-times-circle"></i> {{ Session::get('failed_message') }}
                                </p>
                            @endif
                            <div class="table-wrap">
                                <table id="cat_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Auto Reply Name</th>
                                        <th class="text-center text-white">Page Name</th>
                                        <th class="text-center text-white">Status</th>
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
@endsection

@section("dc-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#cat_list_table').DataTable({
                dom: 'frtip',
                responsive: true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "bPaginate": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('auto.reply.get') }}",
                    data: function (d) {
                        d.shop_id = $('select[name=shop_id] option:selected').val();
                    }
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [1, 2, 3]
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'shop.page_name', name: 'shop.page_name'},
                    {
                        'render': function (data, type, row) {
                            let color = row.status === 1 ? "success" : "danger";
                            let text = row.status === 1 ? "Active" : "Inactive";
                            if (row.status === 1) {
                                return '<span class="badge badge-pill badge-' + color + ' pr-15 pl-15">' + text + '</span>';
                            } else {
                                return '<span class="badge badge-pill badge-danger pr-15 pl-15">Page Disconnected</span>';
                            }
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            if (row.shop.page_connected_status === 1) {
                                return '<a style="min-width: 101px;border:1px solid" class="shadow btn btn-sm pr-15 pl-15 btn-outline-dark" ' +
                                    '   href="/admin/bot/create-auto-reply-form?mode=update&arid=' + row.id + '">' +
                                    '   Update</a>';
                            } else {
                                return '<a href="/admin/shop-billing/shop-list" style="min-width: 101px;border:1px solid" class="shadow btn btn-sm pr-15 pl-15 btn-outline-success">Connect</a>';
                            }
                        },
                    }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });

        $('#btnFiterSubmitSearch').click(function () {
            $('#cat_list_table').DataTable().draw(true);
        });
    </script>
@endsection

@section("dc-css")
    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>
    <style>
        #cat_list_table {
            margin-right: 10px;
        }

        .dataTables_filter {
            margin-top: -10px;
        }

        .dataTables_filter label {
            text-align: left;
        }

        .pagination {
            display: block !important;
            margin-top: 10px !important;
        }

        .paginate_button {
            padding: 0 !important;
        }
    </style>
@endsection

