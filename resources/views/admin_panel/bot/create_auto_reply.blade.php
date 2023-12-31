@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-50 mt-lg-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i
                    class="fa fa-plus"> {{$auto_reply_details!==null ? "Update Auto Reply" : "Create Auto Reply"}}</i>
            </h2>
        </div>
        <!-- /Title -->
        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <p class="text-danger" style="font-size: 20px">
                    Note:
                    <span class="text-primary" style="font-size: 17px">
                        আপনি যদি আপনার কোন পোস্ট এর কমেন্টস গুলোর উত্তর স্বয়ংক্রিয় ভাবে দিতে চান তাহলে এই ফীচার টি  ব্যাবহার করুন
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
                            <form
                                action="{{$auto_reply_details!==null ? route('auto.reply.update') : route('auto.reply.store')}}"
                                method="post">
                                @csrf

                                <div class="form-group">
                                    <label class="control-label mb-10">Auto Reply name<span
                                            class="text-danger">*</span></label>
                                    <span style="font-size: 12px"> [Max 50 characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" id="ar_name" name="ar_name"
                                               placeholder="Enter Name" class="form-control"
                                               value="{{$auto_reply_details !== null ? $auto_reply_details->name:old('ar_name')}}"
                                               required>
                                    </div>
                                    <label for="ar_name" class="error text-danger"></label>
                                    @if($errors->has('ar_name'))
                                        <p class="text-danger">{{ $errors->first('ar_name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose a shop<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                        </div>
                                        <select class="form-control" id="shop_id" name="shop_id" required>
                                            <option value="0" disabled selected>Select Shop</option>
                                            @if($auto_reply_details !== null)
                                                <option value="{{$auto_reply_details->shop->id}}" selected>
                                                    {{$auto_reply_details->shop->page_name}}
                                                </option>
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

                                @if($auto_reply_details === null)
                                    <div class="form-group">
                                        <label class="control-label mb-10">Choose a Post<span
                                                class="text-danger font-16">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control" id="post_id" name="post_id" required>
                                                <option value="0" disabled selected>Select Post</option>
                                            </select>
                                        </div>
                                        <label for="shop_id" class="error text-danger"></label>
                                        @if($errors->has('post_id'))
                                            <p class="text-danger font-14">{{ $errors->first('post_id') }}</p>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose Products<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        @if($auto_reply_details !== null)
                                            <select class="form-control" id="products_id" name="products_id[]"
                                                    multiple="multiple" required>
                                                <option value="0" disabled>Select Products</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}"
                                                        {{$auto_reply_details->auto_reply_products->contains($product->id) == true ? "selected" : ""}}>
                                                        {{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-control" id="products_id" name="products_id[]"
                                                    multiple="multiple" required>
                                                <option value="0" disabled>Select Products</option>
                                            </select>
                                        @endif
                                    </div>
                                    <label for="shop_id" class="error text-danger"></label>
                                    @if($errors->has('post_id'))
                                        <p class="text-danger font-14">{{ $errors->first('post_id') }}</p>
                                    @endif
                                </div>

                                @if($auto_reply_details!==null)
                                    <div class="form-group">
                                        <label class="control-label mb-10">Select Status<span
                                                class="text-danger">*</span></label>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-chain"></i></span>
                                            </div>

                                            <select class="form-control" name="status" id="status">
                                                <option value="1" {{$auto_reply_details->status == 1 ? 'selected': ''}}>
                                                    Enabled
                                                </option>
                                                <option value="0" {{$auto_reply_details->status == 0 ? 'selected': ''}}>
                                                    Disabled
                                                </option>
                                            </select>
                                        </div>
                                        @if($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        @endif
                                    </div>
                                @endif

                                @if($auto_reply_details !== null)
                                    <input type="hidden" name="auto_reply_id"
                                           value="{{$auto_reply_details !== null ? $auto_reply_details->id : ""}}">
                                @endif

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> {{$auto_reply_details!==null ? "Update" : "Create"}}
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

@section('auto-reply-js')
    <script src="{{asset("assets/admin_panel/vendors/select2/dist/js/select2.full.min.js")}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#post_id').select2();
            $('#products_id').select2();

            $("#shop_id").on('change', function () {
                let shop_id = $(this).val();
                $(".preloader-it").css('opacity', .7).show();

                $.ajax({
                    url: "{{ route('get.page.posts') }}",
                    type: "POST",
                    data: {
                        "shop_id": shop_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (result) {
                        $("#post_id").html("");
                        result = JSON.parse(result)
                        let posts = "";
                        for (let i = 0; i < result.data.length; i++) {
                            if (result.data[i].message != null) {
                                posts += '<option value="' + result.data[i].id + '">' + result.data[i].message + '</option>';
                            }
                        }
                        $("#post_id").html(posts);
                        $(".preloader-it").hide();
                    },
                    error: function (xhr, status, error) {
                        $(".preloader-it").hide();
                    }
                });

                $.ajax({
                    url: "{{ route('get.shop.product') }}",
                    type: "GET",
                    data: {"shop_id": shop_id},
                    success: function (result) {
                        $("#products_id").html("");
                        let products = "";
                        for (let i = 0; i < result.length; i++) {
                            products += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
                        }
                        $("#products_id").html(products);
                        $(".preloader-it").hide();
                    }
                });
            });
        });
    </script>
@endsection

@section('auto-reply-css')
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

        .select2-selection {
            height: 50px !important;
        }
    </style>
@endsection
