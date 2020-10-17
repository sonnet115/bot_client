@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-25 mt-sm-30 mt-15">
        <div>
            <!-- Title -->
            <div class="hk-pg-header align-items-top">
                <div>
                    <h2 class="hk-pg-title text-muted font-weight-700 mb-10"><i class="fa fa-chrome"> Overview</i></h2>
                </div>
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="hk-row">
                        <div class="col-lg-12">
                            <div class="hk-row">
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-primary font-weight-500">
                                                    Total Pages
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                                {{$total_counts['total_pages']}}
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-warning font-weight-500">
                                                    Total Products
                                                </span>
                                                </div>
                                                <br>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                              {{$total_counts['total_products']}}
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-success font-weight-500">
                                                    Total Customers
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                                  {{$total_counts['total_customers']}}
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                <span class="d-block font-15 text-danger font-weight-500">
                                                    Total Orders
                                                </span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-5 text-dark mb-5 font-weight-bold">
                                                   {{$total_counts['total_orders']}}
                                            </span>
                                                <a href="#" class="d-block"
                                                   style="font-size: 14px">Learn more...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hk-row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="hk-legend-wrap mb-10">
                                                <div class="hk-legend">
                                                    <span
                                                        class="d-10 bg-orange-dark-2 rounded-circle d-inline-block"></span>
                                                    <span>Pending</span>
                                                </div>

                                                <div class="hk-legend">
                                                <span
                                                    class="d-10 bg-green-dark-2 rounded-circle d-inline-block"></span>
                                                    <span>Delivered</span>
                                                </div>

                                                <div class="hk-legend">
                                                    <span
                                                        class="d-10 bg-red-dark-2 rounded-circle d-inline-block"></span>
                                                    <span>Cancelled</span>
                                                </div>

                                            </div>
                                            {{--for pie chart data--}}
                                            <input type="hidden" value="{{$total_counts['total_pending']}}"
                                                   id="total_pending">
                                            <input type="hidden" value="{{$total_counts['total_delivered']}}"
                                                   id="total_delivered">
                                            <input type="hidden" value="{{$total_counts['total_cancelled']}}"
                                                   id="total_cancelled">
                                            <div id="e_chart_1" class="echart" style="height:220px;"></div>

                                            <div class="row">
                                                <div class="col-4 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-orange fa fa-warning"></i> Pending
                                                        <hr>
                                                        <i class="text-orange font-20">
                                                            {{($total_counts['total_orders'])*($total_counts['total_pending'])/100}}%
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-green fa fa-flag-checkered "></i> Delivered
                                                         <hr>
                                                        <i class="text-green font-20">
                                                              {{($total_counts['total_orders'])*($total_counts['total_delivered'])/100}}%
                                                        </i>
                                                    </span>
                                                </div>

                                                <div class="col-4 text-center">
                                                    <span class="d-block font-14 text-capitalize mb-5">
                                                        <i class="text-red fa fa-check-circle"></i> Cancelled
                                                          <hr>
                                                        <i class="text-red font-20">
                                                              {{($total_counts['total_orders'])*($total_counts['total_cancelled'])/100}}%
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
        </div>
    </div>
@endsection

@section("dashboard-js")
    {{--<!-- EChartJS JavaScript -->--}}
    <script src={{asset("assets/admin_panel/vendors/echarts/dist/echarts-en.min.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/dashboard-data.js")}}></script>
@endsection

@section('dashboard_css')

@endsection
