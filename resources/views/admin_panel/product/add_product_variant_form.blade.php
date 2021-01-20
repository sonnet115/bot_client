@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-plus">
                    {{$product_details !== null ? "Update" : "Add " }} Product Variant</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
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
                                action="{{$product_details != null ? route('product.update') : route('product.store')}}"
                                method="post" novalidate enctype="multipart/form-data" id="order_form">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Choose a Product<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">

                                        <select class="form-control" id="product_name" name="product_name" required>
                                            <option disabled selected>Select Product</option>
                                            @if($product_details !== null)
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}"
                                                        {{$shop->id == $product_details->shop_id ? "selected" : ""}}>
                                                        {{$shop->page_name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($products as $product)
                                                    <option value="{{$product->id.'_'.$product->name}}"
                                                        {{old('product_name') == $product->id ? "selected" : ""}}>
                                                        {{$product->name}} ({{$product->shop->page_name}})
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <label for="product_price" class="error text-danger"></label>
                                    @if($errors->has('shop_id_name'))
                                        <p class="text-danger font-14">{{ $errors->first('shop_id_name') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10">Product Code<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 15 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-code"></i></span>
                                        </div>
                                        <input type="text" id="product_code" name="product_code"
                                               placeholder="Enter Product Code" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->code : old('product_code')}}">
                                    </div>
                                    <label for="product_code" class="error text-danger"></label>
                                    @if($errors->has('product_code'))
                                        <p class="text-danger font-14">{{ $errors->first('product_code') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Stock Amount</label>
                                    <span class="text-muted font-12">[Max 1,000,00]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-circle-thin"></i></span>
                                        </div>
                                        <input type="text" id="product_stock" name="product_stock"
                                               placeholder="Enter Product Stock Amount" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->stock : old('product_stock')}}">
                                    </div>
                                    <label for="product_stock" class="error text-danger"></label>
                                    @if($errors->has('product_stock'))
                                        <p class="text-danger font-14">{{ $errors->first('product_stock') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Unit of Measurement (UoM)<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 10 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-circle-thin"></i></span>
                                        </div>
                                        <input type="text" id="product_uom" name="product_uom"
                                               placeholder="Enter Product UoM" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->uom : old('product_uom')}}">
                                    </div>
                                    <label for="product_uom" class="error text-danger"></label>
                                    @if($errors->has('product_uom'))
                                        <p class="text-danger font-14">{{ $errors->first('product_uom') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Product Price<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 5,000,00]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="text" id="product_price" name="product_price"
                                               placeholder="Enter Product Price" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->price : old('product_price')}}">
                                    </div>
                                    <label for="product_price" class="error text-danger"></label>
                                    @if($errors->has('product_price'))
                                        <p class="text-danger font-14">{{ $errors->first('product_price') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose a shop<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-shuffle"></i></span>
                                        </div>
                                        <input type="text" id="shop_name" name="shop_name"
                                               placeholder="Enter Product Price" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->price : old('shop_name')}}">
                                    </div>
                                    <label for="product_price" class="error text-danger"></label>
                                    @if($errors->has('shop_name'))
                                        <p class="text-danger font-14">{{ $errors->first('shop_name') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10">Choose Category<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-shuffle"></i></span>
                                        </div>
                                        <input type="text" id="category_name" name="category_name"
                                               placeholder="Enter Product Price" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->price : old('category_name')}}">
                                    </div>
                                    <label for="category_ids" class="error text-danger"></label>
                                    @if($errors->has('category_name'))
                                        <p class="text-danger font-14">{{ $errors->first('category_name') }}</p>
                                    @endif
                                </div>

                                <div id="specification_container">
                                    @foreach($variants as $variant)
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{$variant->name}}<span
                                                    class="text-danger font-16">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-shuffle"></i></span>
                                                </div>
                                                <select class="form-control" required name="{{$variant->id}}">
                                                    <option disabled selected>Select {{$variant->name}}</option>
                                                    @foreach($variant->variantProperties as $property)
                                                        @if($property->description != null)
                                                            <option
                                                                value="{{$property->id}}">{{$property->property_name}}
                                                                ({{$property->description}})
                                                            </option>
                                                        @else
                                                            <option
                                                                value="{{$property->id}}">{{$property->property_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="" class="error text-danger"></label>
                                        </div>
                                    @endforeach
                                </div>

                                {{--<label class="control-label mb-10">Product Images<span
                                        class="text-danger font-16">*</span></label>
                                <span class="text-muted font-12">[Max 1 MB | Upload at least 1 image]</span>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <img
                                                src="{{$product_details !== null ? asset("images/products")."/".$product_details->images[0]->image_url : asset("images/products/no.png")}}"
                                                height="200" width="200" alt="N/A"
                                                style="float: left" class="mb-2 product_images">
                                            <a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"
                                               style="float:left;margin: 5px 0 0 -25px;display: none;padding: 1px 7px">X</a>
                                        </div>

                                        <input type="file" name="product_image_1" class="image_files"/>

                                        <p class="text-danger font-14 image_error_message mb-3"></p>
                                        @if($errors->has('product_image_1'))
                                            <p class="text-danger font-14 mb-3">{{ $errors->first('product_image_1') }}</p>
                                        @endif
                                    </div>

                                    <div class="col-sm-6">
                                        <div>
                                            <img
                                                src="{{$product_details !== null ? count($product_details->images) > 1 ? asset("images/products")."/".$product_details->images[1]->image_url : asset("images/products/no.png") : asset("images/products/no.png")}}"
                                                height="200" width="200" alt="N/A"
                                                style="float: left" class="mb-2 product_images">
                                            <a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"
                                               style="float:left;margin: 5px 0 0 -25px;display: none;padding: 1px 7px">X</a>
                                        </div>

                                        <input type="file" name="product_image_2" class="image_files"/>

                                        <p class="text-danger font-14 image_error_message mb-3"></p>
                                        @if($errors->has('product_image_2'))
                                            <p class="text-danger font-14 mb-3">{{ $errors->first('product_image_2') }}</p>
                                        @endif
                                    </div>
                                </div>--}}

                                @if ($product_details !== null)
                                    <div class="form-group">
                                        <label class="control-label mb-10">Product State</label>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-magnet"></i></span>
                                            </div>
                                            <select id="product_state" name="product_state">
                                                <option
                                                    value="0" {{$product_details->state === 0 ? "selected" : ""}}>
                                                    Inactive
                                                </option>
                                                <option
                                                    value="1" {{$product_details->state === 1 ? "selected" : ""}}>
                                                    Active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <input type="hidden" name="product_id"
                                       value="{{$product_details !== null ? $product_details->id : ""}}">

                                <input type="hidden" name="old_product_code"
                                       value="{{$product_details !== null ? $product_details->code : ""}}">

                                <input type="text" name="shop_id_name" id="shop_id_name" value="{{old('shop_id_name')}}">
                                <input type="text" name="category_ids" id="category_ids" value="{{old('category_ids')}}">
                                <input type="text" name="parent_id" id="parent_id" value="{{old('parent_id')}}">

                                <input type="hidden" name="image_1_id"
                                       value="{{$product_details !== null ? $product_details->images[0]->id : ""}}">

                                <input type="hidden" name="image_2_id"
                                       value="{{$product_details !== null ? count($product_details->images) > 1 ? $product_details->images[1]->id : "" : ""}}">
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> {{ $product_details !== null ? "Update" : "Save" }}
                                        Product
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

@section('product-js')
    {{--Select 2--}}
    <script src="{{asset("assets/admin_panel/vendors/select2/dist/js/select2.full.min.js")}}"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#product_name").on('change', function () {
                let pid = $(this).val().split("_");
                $(".preloader-it").css('opacity', .5).show();

                $.ajax({
                    url: "{{ route('get.product.details') }}",
                    type: "POST",
                    data: {"pid": pid[0]},
                    success: function (result) {
                        console.log(result);
                        $("#product_code").val(result.code);
                        $("#parent_id").val(pid[0]);
                        $("#product_stock").val(result.stock);
                        $("#product_uom").val(result.uom);
                        $("#product_price").val(result.price);
                        $("#shop_name").val(result.shop.page_name);
                        $("#shop_id_name").val(result.shop.id + '_' + result.shop.page_name);
                        $("#category_ids").val(result.category.id);
                        $("#category_name").val(result.category.name);
                        $(".preloader-it").hide();
                    }
                });
            });
            $('#product_name').select2();

            /*jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });

            $("#order_form").validate({
                rules: {
                    product_name: {
                        required: true,
                        maxlength: 30
                    },
                    product_code: {
                        required: true,
                        maxlength: 15
                    },
                    product_stock: {
                        max: 100000,
                        digits: true
                    },
                    product_uom: {
                        required: true,
                        maxlength: 10
                    },
                    product_price: {
                        required: true,
                        max: 500000,
                        number: true
                    },
                    category_ids: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: "Name is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_code: {
                        required: "Code is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_stock: {
                        maxlength: "Max value {0}"
                    },
                    product_uom: {
                        required: "UoM is required",
                        maxlength: "Max {0} Characters"
                    },
                    product_price: {
                        required: "Price is required",
                        maxlength: "Max value {0}"
                    },
                    category_ids: {
                        required: "Category is required",
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                },
            });*/

            $(".image_files").on('change', function () {
                displayImage($(this));
            });

            $("#shop_id").on('change', function () {
                $(".preloader-it").css('opacity', .5).show();

                let shop_id = $(this).val();
                $.ajax({
                    url: "{{ route('get.shop.category') }}",
                    type: "POST",
                    data: {"shop_id": shop_id},
                    success: function (result) {
                        $("#category_ids").html("");
                        let categories = "";
                        for (let i = 0; i < result.length; i++) {
                            categories += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
                        }
                        $("#category_ids").html(categories);
                        $(".preloader-it").hide();
                    }
                });
            });

            $(".remove_image_btn").on("click", function () {
                $(this).parent().find('.product_images').attr('src', '{{asset("images/products/no.png")}}');
                $(this).parent().parent().find('.image_files').val('');
                $(this).parent().parent().find('.image_error_message').html('');
                $(this).hide();
            });

            function displayImage(input_object) {
                let input_field = input_object[0];
                let image_file = input_field.files[0];
                let file_type = image_file["type"];
                let valid_image_types = ["image/jpg", "image/jpeg", "image/png"];

                if (input_field.files && image_file && $.inArray(file_type, valid_image_types) > 0) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        input_object.parent().find('.product_images').attr('src', e.target.result);
                        input_object.parent().find('.remove_image_btn').show();
                        input_object.parent().find('.image_error_message').html('');
                    };
                    reader.readAsDataURL(input_field.files[0]); // convert to base64 string
                } else {
                    input_object.parent().find('.image_error_message').html('Invalid Image! Only png, jpg, jpeg allowed');
                }
            }
        });
    </script>
@endsection

@section("product-css")
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }
    </style>
@endsection
