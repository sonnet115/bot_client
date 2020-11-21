@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-50 mt-lg-15">
        <!-- filter starts-->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-filter">&nbsp;Filter
                Orders</i>
        </h4>
        <div class="d-flex flex-wrap mb-20 mb-lg-0">
            <!--start date filter starts-->
            <div class="form-group col-md-2">
                <h5 style="font-size: 16px;color: #708090">From:<span class="text-danger"></span></h5>
                <div class="controls">
                    <input class="form-control discount_date" autocomplete="off" type="text" name="start_date"
                           id="start_date" value=""/>
                </div>
            </div>
            <!--start date filter starts-->

            <!--end date filter starts-->
            <div class="form-group col-md-2">
                <h5 style="font-size: 16px;color: #708090">To:<span class="text-danger"></span></h5>
                <div class="controls">
                    <input class="form-control discount_date" autocomplete="off" type="text" name="end_date"
                           id="end_date" value=""/>
                </div>
            </div>
            <!--end date filter ends-->

            <!-- state starts-->
            <div class="form-group col-md-2">
                <h5 style="font-size: 16px;color: #708090">Status<span class="text-danger"></span></h5>
                <select class="form-control" name="status">
                    <option value="" selected>All Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Processing</option>
                    <option value="2">Dispatched</option>
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
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-list-alt"> Orders List</i></h4>
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @endif
                            <div class="table-wrap">
                                <table id="order_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Order Code</th>
                                        <th class="text-center text-white">Order Date</th>
                                        <th class="text-center text-white">Status Updated By</th>
                                        <th class="text-center text-white">Status</th>
                                        <th class="text-center text-white">Details</th>
                                        <th class="text-center text-white">Change Status</th>
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

        <!-- Modal body starts-->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-muted text-uppercase">
                            Order Code: <span class="text-dark" id="order_code_display"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="overflow: auto">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <p class="text-uppercase text-muted">Ordered Products</p>
                                <table class="table table-responsive table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold">Name</th>
                                        <th class="font-weight-bold">Price</th>
                                        <th class="font-weight-bold">Quantity</th>
                                        <th class="font-weight-bold">Discounts</th>
                                        <th class="font-weight-bold">Status</th>
                                        <th class="font-weight-bold">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_table_data">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-lg-4">
                                <p class="text-uppercase text-muted">Customer Details</p>

                                <table class="table table-bordered" style="padding-left: 10px" id="customer_table_data">

                                </table>
                            </div>
                            <!--summary starts-->
                            <div class="col-12 col-md-6 col-lg-3" id="summary_details">

                            </div>
                            <!-- summary ends-->
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal body ends-->
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
            $('#order_list_table').DataTable({
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
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('order.get') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
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
                        "targets": [1, 2, 3, 4]
                    }
                ],

                columns: [
                    {data: 'code', name: 'code'},
                    {
                        'render': function (data, type, row) {
                            return '<span class="font-14">' + moment(row.created_at, 'YYYY/MM/DD HH:mm:ss').format("DD-MMM-YYYY hh:mm A") + '</span>';
                        }
                    },
                    {
                        'render': function (data, type, row) {
                            if (row.status_updated_by) {
                                return '<span class="font-14">' + row.status_updated_by.name + '</span>';
                            } else {
                                return "N/A";
                            }
                        }
                    },
                    {
                        'render': function (data, type, row) {
                            if (row.order_status === 0) {
                                return '<p class="status_text"><span class=" badge badge-info rounded-10 pl-4 pr-4">Pending</span></p>';
                            } else if (row.order_status === 1) {
                                return '<p class="status_text"><span class="badge badge-primary rounded-10 pl-4 pr-4">Processing</span></p>';
                            } else if (row.order_status === 2) {
                                return '<p class="status_text"><span class="badge badge-warning rounded-10 pl-4 pr-4">Dispatched</span></p>';
                            } else if (row.order_status === 3) {
                                return '<p class="status_text"><span class="badge badge-success rounded-10 pl-4 pr-4">Delivered</span></p>';
                            } else if (row.order_status === 4) {
                                return '<p class="status_text"><span class="badge badge-danger rounded-10 pl-4 pr-4">Cancelled</span></p>';
                            }
                        }
                    },
                    {
                        'render': function (data, type, row) {
                            let details_button = ' <div class="text-center">' +
                                '<button type="button" class="font-11 btn btn-sm btn-outline-dark order_details" style="border: 1px solid !important" ' +
                                '> View\n' +
                                '  </button>' +
                                '<input type="hidden" value="' + row.id + '" class="order_id">' +
                                '<input type="hidden" value="' + row.code + '" class="order_code_display">' +
                                '</div>';

                            return details_button;
                        },
                    },
                    {
                        'render': function (data, type, row) {
                            let status_button = '<div class="dropdown">' +
                                '<select class="form-control order_status font-11" name="order_status">\n' +
                                '  <option selected disabled>Change</option>\n' +
                                '  <option value="0">Pending</option>\n' +
                                '  <option value="1">Processing</option>\n' +
                                '  <option value="2">Dispatched</option>\n' +
                                '  <option value="3">Delivered</option>\n' +
                                '  <option value="4">Cancelled</option>\n' +
                                '</select>' +
                                '<input type="hidden" value="' + row.id + '" class="order_id">' +
                                '</div>';
                            return status_button;
                        },
                    },
                ],

                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });

            //order status
            $(document).on("change", ".order_status", function () {
                let order_id = $(this).parent().find('.order_id').val();
                let order_status_text = $(this).find('option:selected').text();
                let order_status = $(this).val();
                let order_status_container = $(this).parent().parent().parent().find('.status_text');
                order_status_container.html('<span class="badge badge-dark rounded-10 pl-4 pr-4">Updating...</span>');

                $.ajax({
                    type: "GET",
                    url: "{{route('order.status.change')}}",
                    data: {
                        order_id: order_id,
                        order_status: order_status,
                    },
                    success: function (response) {
                        let v = "";
                        if (order_status == 0) {
                            v = '<span class=" badge badge-info rounded-10 pl-4 pr-4">Pending</span>';
                        } else if (order_status == 1) {
                            v = '<span class="badge badge-primary rounded-10 pl-4 pr-4">Processing</span>';
                        } else if (order_status == 2) {
                            v = '<span class="badge badge-warning rounded-10 pl-4 pr-4">Dispatched</span>';
                        } else if (order_status == 3) {
                            v = '<span class="badge badge-success rounded-10 pl-4 pr-4">Delivered</span>';
                        } else if (order_status == 4) {
                            v = '<span class="badge badge-danger rounded-10 pl-4 pr-4">Cancelled</span>';
                        }
                        order_status_container.html(v);
                    }
                });
            });

            //order details modal information
            $(document).on("click", ".order_details", function () {
                $('#product_table_data tr').remove();
                $('#customer_table_data td').remove();
                $('#total_price').html("");
                $('#total_discount').html("");
                let order_id = $(this).parent().find('.order_id').val();
                let order_code = $(this).parent().find('.order_code_display').val();
                let view_details_button = $(this);
                view_details_button.prop('disabled', true);
                $("#order_code_display").html(order_code);
                $.ajax({
                    type: "GET",
                    url: "{{route('order.details.get')}}",
                    data: {
                        order_id: order_id
                    },

                    success: function (response) {
                        view_details_button.prop('disabled', false);
                        console.log(response);
                        //order details
                        for (let i = 0; i < response.ordered_products.length; i++) {
                            let row = myOrder(response, i);
                            $('#product_table_data').append(row);
                        }

                        //customer details
                        let customer = myCustomers(response);
                        $('#customer_table_data').append(customer);

                        //summary details
                        let summary = summaryCalculation(response);
                        let subtotal = summary['total_price'];
                        let total_discount = summary['total_discount'];
                        let delivery_charge = 0;

                        if (subtotal) {
                            delivery_charge = response.delivery_charge;
                        }

                        let total_price = (subtotal - total_discount) + delivery_charge;

                        let summary_elem = summaryDetails(subtotal, total_discount, delivery_charge, total_price);
                        $('#summary_details').html(summary_elem);

                        $('#myModal').modal('toggle');
                    }
                });
            });

            $('.discount_date').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                }
            });

            $('#start_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('#end_date').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('#orderFilterButton').click(function () {
                $('#order_list_table').DataTable().draw(true);
            });
        });

        //product status in modal
        $(document).on("change", ".product_status_select", function () {
            let new_product_status = $(this).val();
            let product_status_parent = $(this).parent().parent();
            let product_id = product_status_parent.find('.product_id').val();
            let order_id = product_status_parent.find('.order_id').val();
            let old_product_status = product_status_parent.find('.old_product_status').val();
            product_status_parent.find('.old_product_status').val(new_product_status);

            $.ajax({
                type: "GET",
                url: "{{route('order.status.get')}}",
                data: {
                    product_status: new_product_status,
                    product_id: product_id,
                    order_id: order_id
                },
                success: function (response) {
                    let product_status = product_status_parent.find('.product_status_td');

                    if ((response.product_status) === 0) {
                        product_status.html("<span class='badge badge-pill badge-info'>Pending</span>");
                    }
                    if ((response.product_status) === 1) {
                        product_status.html("<span class='badge badge-pill badge-primary'>Processing</span>");
                    }
                    if ((response.product_status) === 2) {
                        product_status.html("<span class='badge badge-pill badge-warning'>Shipping</span>");
                    }
                    if ((response.product_status) === 3) {
                        product_status.html("<span class='badge badge-pill badge-success'>Delivered</span>");
                    }
                    if ((response.product_status) === 4) {
                        product_status.html("<span class='badge badge-pill badge-danger'>Cancelled</span>");
                    }

                    if (old_product_status !== new_product_status) {
                        // adjustOnchangeTotalPrice(response);
                        if (new_product_status === "0" || new_product_status !== "1" || new_product_status !== "2" || new_product_status !== "3") {
                            if (old_product_status === "4") {
                                adjustOnchangeTotalPrice(response);
                            }
                        }

                        if (new_product_status === "4") {
                            adjustOnchangeTotalPrice(response);
                        }
                    }
                }
            });
        });

        //order details functions
        function myOrder(response, i) {
            let product_status_show = "";
            let product_status = response.ordered_products[i].pivot.product_status;

            if (product_status === 0) {
                product_status_show = '<span class="badge badge-pill badge-info">Pending</span>';
            }
            if (product_status === 1) {
                product_status_show = '<span class="badge badge-pill badge-primary">Processing</span>';
            }
            if (product_status === 2) {
                product_status_show = '<span class="badge badge-pill badge-warning">Shipping</span>';
            }
            if (product_status === 3) {
                product_status_show = '<span class="badge badge-pill badge-success">Delivered</span>';
            }
            if (product_status === 4) {
                product_status_show = '<span class="badge badge-pill badge-danger">Cancelled</span>';
            }

            return '<tr style="font-size: 15px">\n' +
                '        <td>' + response.ordered_products[i].name + '</td>\n' +
                '        <td>' + response.ordered_products[i].price + '</td>\n' +
                '        <td>' + response.ordered_products[i].pivot.quantity + '<span>Sets</span></td>\n' +
                '        <td>' + response.ordered_products[i].pivot.discount + '</td>\n' +
                '        <td class="product_status_td">' + product_status_show + '</td>\n' +
                '        <td>' +
                '           <select name="cars" class="form-control product_status_select" style="font-size: 13px">\n' +
                '               <option value="" selected>Choose Status</option>\n' +
                '               <option value="0">Pending</option>\n' +
                '               <option value="1">Processing</option>\n' +
                '               <option value="2">Dispatched</option>\n' +
                '               <option value="3">Delivered</option>\n' +
                '               <option value="4">Cancelled</option>\n' +
                '           </select>' +
                '           <input type="hidden" class="product_id" value="' + response.ordered_products[i].id + '">' +
                '           <input type="hidden" class="order_id" value="' + response.id + '">' +
                '           <input type="hidden" class="old_product_status" value="' + product_status + '">' +
                '       </td>\n' +
                '      </tr>';
        }

        function myCustomers(response) {
            let customer = '<thead>\n' +
                '             <tr>\n' +
                '                <td style="border-top: 1px solid lightgray">Name</td>\n' +
                '                <td style="border-top: 1px solid lightgray">' + response.customer_name + '</td>\n' +
                '             </tr>\n' +
                '        </thead>\n' +
                '        <tbody id="customer_table_data">\n' +
                '              <tr>\n' +
                '                <td>Billing Address</td>\n' +
                '                <td>' + response.billing_address + '</td>\n' +
                '              </tr>\n' +
                '              <tr>\n' +
                '                 <td>Shipping Address</td>\n' +
                '                 <td>' + response.shipping_address + '</td>\n' +
                '               </tr>\n' +
                '               <tr>\n' +
                '                  <td>Contact Number</td>\n' +
                '                  <td>' + response.contact +
                '                  <input type="hidden" value="' + response.delivery_charge + '" id="old_delivery_charge">' +
                '                  </td>\n' +
                '               </tr>\n' +
                '        </tbody>';

            return customer;
        }

        //summary details functions
        function summaryDetails(subtotal, discount, delivery, total) {
            return '<div class="border-bottom">\n' +
                '        <p class="text-muted text-uppercase">Order Summary</p>\n' +
                '        <p class="ml-5 font-13">Subtotal: <span id="subtotal">' + subtotal + '</span> <span>BDT</span></p>\n' +
                '        <p class="ml-5 font-13">Discounts: <span>-</span> <span id="discount">' + discount + '</span> <span>BDT</span></p>\n' +
                '        <p class="ml-5 font-13">Delivery Fee: <span>+</span> <span id="delivery_charge">' + delivery + '</span> <span>BDT</span></p>\n' +
                '   </div>\n' +
                '   <div>\n' +
                '       <p class="text-dark">Total: <span>' + total + '</span> BDT</p>\n' +
                '   </div>';
        }

        function summaryCalculation(response) {
            let total_price = 0;
            let total_discount = 0;
            for (let i = 0; i < response.ordered_products.length; i++) {
                if (response.ordered_products[i].pivot.product_status !== 4) {
                    let quantity = response.ordered_products[i].pivot.quantity;
                    let price = response.ordered_products[i].pivot.price;
                    let discount = response.ordered_products[i].pivot.discount;
                    total_discount = total_discount + discount;
                    total_price = total_price + (price * quantity);
                }
            }
            return {total_price: total_price, total_discount: total_discount};
        }

        function adjustOnchangeTotalPrice(response) {
            //console.log(response);
            let adjusted_subtotal, adjusted_discount, total, delivery_charge;

            //old values
            let old_subtotal = parseFloat(document.getElementById("subtotal").innerText);
            let old_discount = parseFloat(document.getElementById("discount").innerText);

            delivery_charge = parseFloat(document.getElementById("delivery_charge").innerText);

            //new values
            let new_quantity = parseFloat(response.quantity);
            let new_price = parseFloat(response.price);
            let new_discount = parseFloat(response.discount);

            adjusted_subtotal = old_subtotal;
            adjusted_discount = old_discount;

            if (response.product_status === 4) {
                adjusted_discount = adjusted_discount - (new_quantity * new_discount);
                adjusted_subtotal = adjusted_subtotal - (new_quantity * new_price);
            } else {
                adjusted_discount = adjusted_discount + (new_quantity * new_discount);
                adjusted_subtotal = adjusted_subtotal + (new_quantity * new_price);
            }

            if (!adjusted_subtotal) {
                delivery_charge = 0;
            } else {
                delivery_charge = parseFloat($("#old_delivery_charge").val());
            }

            total = (adjusted_subtotal - adjusted_discount) + delivery_charge;
            $('#summary_details').html(summaryDetails(adjusted_subtotal, adjusted_discount, delivery_charge, total));
        }

        //for filtered datatable draw
        $('#btnFiterSubmitSearch').on("click", function () {
            $('#order_list_table').DataTable().draw(true);
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
