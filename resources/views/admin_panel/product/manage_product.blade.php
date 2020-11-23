@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-50 mt-lg-15">
        <!-- filter starts-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-filter">&nbsp;Filter
                Products</i>
        </h4>
        <p style="font-size: 20px">Stock</p>
        <div class="d-flex flex-wrap">
            <!--stock filter starts-->
            <div class="form-group p2">
                <div class="controls">
                    <input class="form-control" type="text" placeholder="Start Range" name="stock_from" value=""/>
                </div>
            </div>
            {{--<div class="form-group p-2">
                <p class="text-center font-15">To</p>
            </div>--}}
            <div class="form-group pl-2">
                <div class="controls">
                    <input class="form-control" type="text" placeholder="End Range" name="stock_to" id="stock_to"
                           value=""/>
                </div>
            </div>
            <!--stock filter ends-->

            <!-- state starts-->
            <div class="form-group pl-2">
                <p style="font-size: 20px;margin-top: -30px">Status</p>
                <select class="form-control" name="status">
                    <option value="" selected>All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <!--state ends-->

            <!-- page starts-->
            <div class="form-group pl-2">
                <p style="font-size: 20px;margin-top: -30px">Page</p>
                <select class="form-control" id="shop_id" name="shop_id">
                    <option value="" selected>All</option>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->page_name}}</option>
                    @endforeach
                </select>
            </div>
            <!--page ends-->

            <!-- category starts-->
            <div class="form-group pl-2">
                <p style="font-size: 20px;margin-top: -30px">Category</p>
                <select class="form-control" id="category_id" name="category_id">

                </select>
            </div>
            <!--category ends-->

            <!--button-->
            <div class="text-left pl-4">
                <button id="btnFiterSubmitSearch" class="btn btn-primary"><i
                        class="fa fa-filter">&nbsp;</i>Filter
                </button>
            </div>
            <!--button ends-->
        </div>
        <!-- filter ends-->

        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Product
                List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            <span class="font-18 connect_text text-primary"></span>
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
                                <table id="product_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Name</th>
                                        <th class="text-center text-white">Code</th>
                                        <th class="text-center text-white">Stock</th>
                                        <th class="text-center text-white">UoM<p style="font-size: 10px">(Unit of
                                                measurement)</p></th>
                                        <th class="text-center text-white">Price</th>
                                        <th class="text-center text-white">Page Name</th>
                                        <th class="text-center text-white">Category</th>
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
                        d.category_id = $('select[name=category_id] option:selected').val();
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
                    {data: 'category.name', name: 'category.name'},
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
                                return '<a href="/admin/shop-billing/shop-list" style="min-width: 101px;border:1px solid" class="shadow btn btn-sm pr-15 pl-15 btn-outline-success">Connect</a>';
                            }

                        },
                    },
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });

            $("#shop_id").on('change', function () {
                $(".preloader-it").css('opacity', .5).show();

                let shop_id = $(this).val();
                $.ajax({
                    url: "{{ route('get.shop.category') }}",
                    type: "POST",
                    data: {"shop_id": shop_id},
                    success: function (result) {
                        $("#category_id").html("");
                        let categories = "<option selected value=''>All</option>";
                        for (let i = 0; i < result.length; i++) {
                            categories += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
                        }
                        $("#category_id").html(categories);
                        $(".preloader-it").hide();
                    }
                });
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
            margin-top: 10px !important;
        }

        .paginate_button {
            padding: 0 !important;
        }
    </style>
@endsection
