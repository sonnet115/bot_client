@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-50 mt-lg-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i
                    class="fa fa-plus"> {{$dc_details!==null ? "Update Delivery Charge" : "Add Delivery Charge"}}</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
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
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{$dc_details!==null ? route('dc.update') : route('dc.store')}}"
                                  method="post" id="discount_form">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Delivery Charge Name<span
                                            class="text-danger">*</span></label>
                                    <span style="font-size: 12px"> [Max 20 characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" id="dc_name" name="dc_name"
                                               placeholder="Enter Delivery Charge Name" class="form-control"
                                               value="{{$dc_details!==null ? $dc_details->name : old('dc_name')}}"
                                               required>
                                    </div>
                                    <label for="dc_name" class="error text-danger"></label>
                                    @if($errors->has('dc_name'))
                                        <p class="text-danger">{{ $errors->first('dc_name') }}</p>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Delivery Charge Amount<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input class="form-control discount_date" type="text" name="dc_amount"
                                               placeholder="Enter Delivery Charge Cost"
                                               value="{{$dc_details!==null ? $dc_details->delivery_charge : old('dc_amount')}}"
                                               id="dc_amount"/>
                                    </div>
                                    <label for="dc_amount" class="error text-danger"></label>
                                    @if($errors->has('dc_amount'))
                                        <p class="text-danger">{{ $errors->first('dc_amount') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose a shop<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-shuffle"></i></span>
                                        </div>
                                        <select class="form-control" id="shop_id" name="shop_id" required>
                                            <option value="0" disabled selected>Select shop</option>
                                            @if($dc_details !== null)
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id}}"
                                                        {{$shop->id == $dc_details->shop_id ? "selected" : ""}}>
                                                        {{$shop->page_name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id}} ">
                                                        {{$shop->page_name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <label for="shop_id" class="error text-danger"></label>
                                    @if($errors->has('shop_id'))
                                        <p class="text-danger font-14">{{ $errors->first('shop_id') }}</p>
                                    @endif
                                </div>

                                @if($dc_details !== null)
                                    <input type="hidden" name="dc_id"
                                           value="{{$dc_details !== null ? $dc_details->id : ""}}">
                                @endif

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-plus-circle"></i> {{$dc_details!==null ? "Update" : "Save"}}
                                        Delivery Charge
                                    </button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
@endsection

@section('discount-js')
    <!-- Daterangepicker JavaScript -->
    <script src={{asset("assets/admin_panel/vendors/moment/min/moment.min.js")}}></script>
    <script src={{asset("assets/admin_panel/vendors/daterangepicker/daterangepicker.js")}}></script>
    <script src={{asset("assets/admin_panel/dist/js/daterangepicker-data.js")}}></script>


    <!-- validation cdn--->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();

            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });

            $("#discount_form").validate({
                rules: {
                    dc_name: {
                        required: true,
                        maxlength: 20
                    },

                    dc_amount: {
                        required: true
                    },

                    shop_id: {
                        required: true,
                    }
                },
                messages: {
                    dc_name: {
                        required: "Name is required",
                    },

                    dc_amount: {
                        required: "Amount is required",
                    },

                    shop_id: {
                        required: "Select a shop",
                    },
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

    </script>
@endsection

@section('discount-css')
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }

        .select2-selection__choice__display {
            color: #f40600 !important;
        }
    </style>
@endsection
