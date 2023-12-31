@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-20 mt-sm-30 mt-15">
        <!-- Product List starts -->
        <h4 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-list-alt"> Billing History</i></h4>
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
                                <table id="billing_list_table" class="table table-bordered w-100 display">
                                    <thead class="btn-gradient-info">
                                    <tr>
                                        <th class="text-center text-white" data-priority="1">Page Name</th>
                                        <th class="text-center text-white"> Subscription Status</th>
                                        <th class="text-center text-white"> Date of payment</th>
                                        <th class="text-center text-white"> Paid Amount</th>
                                        <th class="text-center text-white"> Next Payable Amount</th>
                                        <th class="text-center text-white"> Next Due Date</th>
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

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Payment Methods</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row" id="payment_steps">
                        {{--<div class="col-12 col-lg-8">
                            <b style="color: #2b383e;font-size: 17px;text-decoration: underline">Payment Steps:</b>
                            <br>
                            <ol style="padding: 10px 30px">
                                <li>Go to bKash Mobile Menu by dialing *247#</li>
                                <li>Choose “Send Money”</li>
                                <li>Enter 01608435599</li>
                                <li>Enter amount ' + amount + ' BDT</li>
                                <li>Enter reference Sept1</li>
                                <li>Now enter your bKash Mobile Menu PIN to confirm</li>
                            </ol>
                        </div>

                        <div class="col-12 col-lg-8">
                            <b style="color: #2b383e;font-size: 19px;text-decoration: underline">After Payment</b>
                            <br>

                            <p>Shop Name</p>
                            <input placeholder="Shop Name" name="shop_name" readonly class="form-control-plaintext">
                            <p id="month">Month Name</p>
                            <input class="form-control" placeholder="Pay for which month" name="month" id="month">
                            <p id="trx_id">Transaction ID</p>
                            <input class="form-control" placeholder="bKash Transaction ID" name="trx_id">
                            <hr>
                            <div class="text-center">
                                <button class="btn btn-sm btn-success confirmPaymentButton">Complete Payment</button>
                            </div>

                        </div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("billing-js")
    <script src={{asset("assets/admin_panel/vendors/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}></script>
    <script
        src={{asset("assets/admin_panel/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dataTables-data.js")}}></script>
    <!-- data table-->
    <script>
        $(document).ready(function () {
            $('#billing_list_table').DataTable({
                dom: 'frtip',
                responsive: true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "bPaginate": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('billing.info.get') }}",
                    type: 'POST',
                },

                "columnDefs": [
                    {
                        "className": "dt-center",
                        "targets": [1, 2, 3, 4, 5, 6]
                    }
                ],
                columns: [
                    {data: 'page_name', name: 'page_name'},
                    {
                        'render': function (data, type, row) {
                            let color = "";
                            let text = "";
                            if (row.page_subscription_status == 1) { //1 = trial
                                color = "warning";
                                text = "Trial";
                            } else if (row.page_subscription_status == 2) {
                                color = "info"
                                text = "Due"
                            } else if (row.page_subscription_status == 3) {
                                color = "success"
                                text = "Paid"
                            } else {
                                color = "danger"
                                text = "Not Paid"
                            }
                            return '<span  style="min-width: 103px" class="badge badge-pill badge-' + color + ' pr-15 pl-15">' + text + '</span>';
                        },
                    },
                    {data: 'billing[0].prev_billing_date', name: 'prev_billing_date'},
                    {data: 'billing[0].paid_amount', name: 'paid_amount'},
                    {data: 'billing[0].payable_amount', name: 'payable_amount'},
                    {data: 'billing[0].next_billing_date', name: 'next_billing_date'},
                    {
                        'render': function (data, type, row) {
                            let color = "success";
                            let text = "Pay Now";
                            let button = "N/A";
                            if (row.billing.length > 0) {
                                button = '<input type="hidden" value="' + row.billing[0].payable_amount + '" class="payable_amount">' +
                                    '<input type="hidden" value="' + row.page_name + '" class="page_name">' +
                                    '<input type="hidden" value="' + row.id + '" class="page_id">' +
                                    '<button style="min-width: 101px;border:1px solid" class="payment-details shadow btn btn-sm pr-15 pl-15 btn-outline-' + color + '">' + text + '</button>';
                            }
                            return button;
                        },
                    }
                ],
                "drawCallback": function () {
                    $('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
                },
            });
        });

        $(document).on("click", ".payment-details", function () {
            let payable_amount = $(this).parent().find('.payable_amount').val();
            let page_name = $(this).parent().find('.page_name').val();
            let page_id = $(this).parent().find('.page_id').val();
            paymentSteps(payable_amount, page_name, page_id);
            $('#myModal').modal('toggle');
        });

        $(document).on("click", ".confirm-payment-button", function () {
            let shop_name = $('input[name=shop_name]').val();
            let page_id = $('input[name=page_id]').val();
            let trx_id = $('input[name=trx_id]').val();
            let message = $('.message');

            $.ajax({
                type: "POST",
                url: "{{route('payment.info.store')}}",
                data: {
                    page_name: shop_name,
                    page_id: page_id,
                    trx_id: trx_id,
                },
                success: function (response) {
                    console.log(response);
                    message.html(response);
                    setTimeout(function () {
                        $("#myModal").modal('toggle');
                    }, 5000);
                }
            });
        });

        function paymentSteps(payable_amount, page_name, page_id) {
            let html = '    <div class="col-12">\n' +
                '                            <b style="color: #2b383e;font-size: 17px;text-decoration: underline">Payment Steps:</b>\n' +
                '                            <br>\n' +
                '                            <ol style="padding: 10px 30px">\n' +
                '                                <li>Go to bKash Mobile Menu by dialing *247#</li>\n' +
                '                                <li>Choose “Send Money”</li>\n' +
                '                                <li>Enter 01608435599</li>\n' +
                '                                <li>Enter amount ' + payable_amount + ' BDT</li>\n' +
                '                                <li>Enter reference 1</li>\n' +
                '                                <li>Now enter your bKash Mobile Menu PIN to confirm</li>\n' +
                '                            </ol>\n' +
                '            </div>\n' +
                '            <div class="col-12">\n' +
                '                            <b style="color: #2b383e;font-size: 19px;text-decoration: underline">After Payment</b>\n' +
                '                            <br>\n' +
                '                            <p>Shop Name</p>\n' +
                '                            <input readonly class="form-control" value="' + page_name + '" placeholder="Shop Name" name="shop_name">\n' +
                '                            <input type="hidden" name="page_id" value="' + page_id + '">\n' +
                '                            <p id="trx_id">Transaction ID</p>\n' +
                '                            <input class="form-control" placeholder="bKash Transaction ID" name="trx_id">\n' +
                '                            <hr>\n' +
                '                            <p class="text-success text-center message"></p>\n' +
                '                            <div class="text-center">\n' +
                '                                <button class="btn btn-sm btn-success confirm-payment-button">Complete Payment</button>\n' +
                '                            </div>\n' +
                '            </div>';
            $("#payment_steps").html(html);
        }
    </script>
@endsection

@section("billing-css")
    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>
    <style>
        .pagination {
            display: block !important;
        }

        td {
            font-size: 11px !important;
        }

        #billing_list_table_length {
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
