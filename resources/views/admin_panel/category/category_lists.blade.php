@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Categories List</i>
        </h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="cat_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1"> Name</th>
                                        <th class="text-center text-white">Shop</th>
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
                    url: "{{ route('category.get') }}",
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [1, 2]
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'shop.page_name', name: 'shop.page_name'},
                    {
                        'render': function (data, type, row) {
                            if (row.shop.page_connected_status === 1) {
                                return '<a style="min-width: 101px;border:1px solid" class="shadow btn btn-sm pr-15 pl-15 btn-outline-dark" ' +
                                    '   href="/admin/category/add-form?mode=update&catid=' + row.id + '">' +
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
        .paginate_button{
            padding: 0px !important;
        }
    </style>
@endsection

