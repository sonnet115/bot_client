@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-50 mt-lg-15">
        <!-- filter starts-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-filter">&nbsp;Filter
                Ordered Products</i>
        </h4>
        <div class="d-flex flex-wrap mb-20 mb-lg-0">
            <!-- state starts-->
            <div class="form-group col-md-2">
                <h5 style="font-size: 16px;color: #708090">Status<span class="text-danger"></span></h5>
                <select class="form-control" name="status">
                    <option value="0" selected>Pending</option>
                    <option value="1">Processing</option>
                    <option value="2">Shipping</option>
                    <option value="3">Delivered</option>
                    <option value="4">Cancelled</option>
                </select>
            </div>
            <!--state ends-->

            <!-- state starts-->
            <div class="form-group col-md-2">
                <h5 style="font-size: 16px;color: #708090">Pages<span class="text-danger"></span></h5>
                <select class="form-control" name="shop_id">
                    <option value="" selected>All Page</option>
                    @foreach($shops as $shop)
                        <option value="{{$shop->id}}">{{$shop->page_name}}</option>
                    @endforeach
                </select>
            </div>
            <!--state ends-->

            <!--button-->
            <div class="text-left col-md-2">
                <button type="text" id="orderFilterButton" class="btn btn-primary" style="margin-top:19px"><i
                        class="fa fa-filter">&nbsp;</i>Filter
                </button>
            </div>
            <!--button ends-->

        </div>
        <!-- filter ends-->

        <!-- Order List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Ordered
                Products List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="ordered_products_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Name</th>
                                        <th class="text-center text-white" >Code</th>
                                        <th class="text-center text-white" data-priority="1">Count</th>
                                        <th class="text-center text-white">Status</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Order list ends -->
    </div>
    <!-- /Container -->
@endsection

@section("order-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>

    <script src={{asset("assets/admin_panel/dist/js/moment.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/moment/min/moment.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/daterangepicker-data.js")}}></script>

    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#ordered_products_table').DataTable({
                dom: 'Blfrtip',
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                    processing: "Loading. Please wait..."
                },

                "lengthMenu": [[25, 50, 100, 500, 10000], [25, 50, 100, 500, "All"]],
                "bPaginate": true,
                "info": true,
                "bFilter": true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ordered.products.get') }}",
                    type: "GET",
                    data: function (d) {
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
                        "targets": [0, 1, 2, 3]
                    }
                ],

                columns: [
                    {
                        'render': function (data, type, row) {
                            return '<span class="font-14">' + row.name + '</span>';
                        }
                    },
                    {
                        'render': function (data, type, row) {
                            return '<span class="font-14">' + row.code + '</span>';
                        }
                    },
                    {
                        'render': function (data, type, row) {
                            return '<span class="font-14">' + row.ordered_products.length + '</span>';
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            let status = $('select[name=status] option:selected').val();
                            if (status == 0) {
                                return '<p class="status_text text-center"><span class=" badge badge-info rounded-10 pl-4 pr-4">Pending</span></p>';
                            } else if (status == 1) {
                                return '<p class="status_text text-center"><span class="badge badge-primary rounded-10 pl-4 pr-4">Processing</span></p>';
                            } else if (status == 2) {
                                return '<p class="status_text text-center"><span class="badge badge-warning rounded-10 pl-4 pr-4">Shipping</span></p>';
                            } else if (status == 3) {
                                return '<p class="status_text text-center"><span class="badge badge-success rounded-10 pl-4 pr-4">Delivered</span></p>';
                            } else if (status == 4) {
                                return '<p class="status_text text-center"><span class="badge badge-danger rounded-10 pl-4 pr-4">Cancelled</span></p>';
                            }
                        },
                    },
                ],

                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });


            $('#orderFilterButton').on("click", function () {
                $('#ordered_products_table').DataTable().draw(true);
            });
        });

        //for filtered datatable draw
        $('#btnFiterSubmitSearch').on("click", function () {
            $('#ordered_products_table').DataTable().draw(true);
        });
    </script>
@endsection

@section('order-css')
    <link href={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.css")}} rel="stylesheet"
          type="text/css"/>
    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>
    <style>
        #order_list_table_length {
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
