@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-50 mt-lg-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Categories
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
                                        <th class="text-center text-white" data-priority="1">Variant Name</th>
                                        <th class="text-center text-white">Property</th>
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
                    url: "{{ route('variant.get') }}",
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [0, 1, 2]
                    }
                ],
                columns: [
                    {data: 'name', name: 'name'},
                    {
                        'render': function (data, type, row) {
                            for (let i = 0; i < row.variant_properties.length; i++) {

                            }
                            return '<span>' + row.variant_properties.map(function (elem) {
                                if (elem.description != null) {
                                    return elem.property_name + ' (' + elem.description + ')';
                                } else {
                                    return elem.property_name;
                                }
                            }).join(", ") + '</span>';
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            return '<a style="min-width: 101px;border:1px solid" class="shadow btn btn-sm pr-15 pl-15 btn-outline-dark" ' +
                                '   href="/admin/variant/add-form?mode=update&vid=' + row.id + '">' +
                                '   Update</a>';
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

