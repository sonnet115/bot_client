@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- filter starts-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-filter">&nbsp;Filter Products</i>
        </h4>
        <p style="font-size: 20px">Stock</p>
        <div class="d-flex flex-wrap">
            <!--stock filter starts-->
            <div class="form-group p2">
                <div class="controls">
                    <input class="form-control" type="text" name="stock_from" value=""/>
                </div>
            </div>
            <div class="form-group p-2">
                <p class="text-center font-15">To</p>
            </div>
            <div class="form-group p2">
                <div class="controls">
                    <input class="form-control" type="text" name="stock_to" id="stock_to" value=""/>
                </div>
            </div>
            <!--stock filter ends-->

            <!-- state starts-->
            <div class="form-group pl-2">
                <select class="form-control" name="status">
                    <option value="" selected>Select a status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <!--state ends-->

            <!-- state starts-->
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
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-info"><i
                        class="fa fa-search">&nbsp;</i>Filter
                </button>
            </div>
            <!--button ends-->
        </div>
        <!-- filter ends-->

        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Product List</i></h4>
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
                                <table id="product_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Name</th>
                                        <th class="text-center text-white">Code</th>
                                        <th class="text-center text-white">Stock</th>
                                        <th class="text-center text-white">UoM</th>
                                        <th class="text-center text-white">Price</th>
                                        <th class="text-center text-white">Shop Name</th>
                                        <th class="text-center text-white">State</th>
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
@section("product-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#product_list_table').DataTable({
                dom: 'Blfrtip',
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                },
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "lengthMenu": [[25, 50, 100, 500, 10000], [25, 50, 100, 500, "All"]],
                "bPaginate": true,
                "info": true,
                "bFilter": true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('product.get') }}",
                    data: function (d) {
                        d.stock_from = $("input[name=stock_from]").val();
                        d.stock_to = $("input[name=stock_to]").val();
                        d.status = $('select[name=status] option:selected').val();
                        d.shop_id = $('select[name=shop_id] option:selected').val();
                    }
                },

                "columnDefs": [
                    {
                        "targets": -1,
                        "className": 'all',
                    },
                    {
                        "className": "dt-center",
                        "targets": [2, 3, 4, 5, 6, 7]
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'stock', name: 'stock'},
                    {data: 'uom', name: 'uom'},
                    {data: 'price', name: 'price'},
                    {data: 'shop.page_name', name: 'shop.page_name'},
                    {
                        'render': function (data, type, row) {
                            let color = row.state === 1 ? "success" : "danger";
                            let text = row.state === 1 ? "Active" : "Inactive";
                            if (row.shop.page_connected_status === 1) {
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
                                    '   href="/admin/product/add-form?mode=update&pid=' + row.id + '">' +
                                    '   Update</a>';
                            } else {
                                return '<button style="min-width: 101px;border:1px solid" onclick="connectPageProduct()" class="shadow btn btn-sm pr-15 pl-15 btn-outline-success">Connect</button>';
                            }

                        },
                    },
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });
        $('#btnFiterSubmitSearch').click(function () {
            $('#product_list_table').DataTable().draw(true);
        });
    </script>
@endsection

@section("product-css")
    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>
    <style>
        #product_list_table {
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
        }
    </style>
@endsection
