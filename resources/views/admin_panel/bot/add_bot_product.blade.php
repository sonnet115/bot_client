@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-50 mt-lg-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase">
                <i class="fa fa-plus"> Select Bot Products </i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <p class="text-danger" style="font-size: 20px">
                    Note:
                    <span class="text-primary" style="font-size: 17px">
                        আপনি আপনার যে যে পণ্য গুলো বট এ এড করতে চান সেই পণ্য গুলো এখানে সিলেক্ট করুন
                    </span>
                </p>
                <section class="hk-sec-wrapper" style="padding-bottom: 0">
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
                            <form action="{{route('bot.products.update')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose a shop<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                        </div>
                                        <select class="form-control" id="shop_id" name="shop_id" required>
                                            <option value="0" disabled selected>Select shop</option>
                                            @foreach($shop_list as $shop)
                                                <option value="{{$shop->id}} ">
                                                    {{$shop->page_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="shop_id" class="error text-danger"></label>
                                    @if($errors->has('shop_id'))
                                        <p class="text-danger font-14">{{ $errors->first('shop_id') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose Products<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" id="products_id" name="products_id[]"
                                                multiple="multiple" required>
                                            <option value="0" disabled>Select Products</option>
                                        </select>
                                    </div>
                                    <label for="shop_id" class="error text-danger"></label>
                                    @if($errors->has('post_id'))
                                        <p class="text-danger font-14">{{ $errors->first('post_id') }}</p>
                                    @endif
                                </div>

                                @if($bot_products !== null)
                                    <input type="hidden" name="category_id"
                                           value="{{$bot_products !== null ? $bot_products->id : ""}}">
                                @endif

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> {{$bot_products!==null ? "Update" : "Create"}}
                                        Auto Reply
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

@section('bot-product-js')
    <script src="{{asset("assets/admin_panel/vendors/select2/dist/js/select2.full.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#post_id').select2();
            $('#products_id').select2();

            $("#shop_id").on('change', function () {
                let shop_id = $(this).val();
                $(".preloader-it").css('opacity', .7).show();

                $.ajax({
                    url: "{{ route('get.bot.products') }}",
                    type: "GET",
                    data: {"shop_id": shop_id},
                    success: function (result) {
                        $("#products_id").html("");
                        let products = "";
                        for (let i = 0; i < result.length; i++) {
                            if (result[i].show_in_bot == 1) {
                                products += '<option value="' + result[i].id + '" selected>' + result[i].name + '</option>';
                            } else {
                                products += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
                            }
                        }
                        $("#products_id").html(products);
                        $(".preloader-it").hide();
                    }
                });
            });
        });
    </script>
@endsection

@section('bot-product-css')
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }

        .select2-selection__choice__display {
            color: #f40600 !important;
        }

        .select2-selection--single {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .select2-results__option {
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        /*.select2-selection {
            height: 50px !important;
        }*/
    </style>
@endsection
