@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i class="fa fa-plus">
                    {{$product_details !== null ? "Update" : "Add New" }} Product</i>
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
                                    <label class="control-label mb-10">Product Name<span
                                            class="text-danger font-16">*</span></label>
                                    <span class="text-muted font-12">[Max 30 Characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>

                                        <input type="text" id="product_name" name="product_name"
                                               placeholder="Enter Product Name" class="form-control"
                                               value="{{ $product_details !== null ? $product_details->name : old('product_name')}}">
                                    </div>
                                    <label for="product_name" class="error text-danger"></label>
                                    @if($errors->has('product_name'))
                                        <p class="text-danger font-14">{{ $errors->first('product_name') }}</p>
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
                                        <select class="form-control" id="shop_id" name="shop_id_name" required>
                                            <option disabled selected>Select shop</option>
                                            @if($product_details !== null)
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id."_".$shop->page_name}}"
                                                        {{$shop->id == $product_details->shop_id ? "selected" : ""}}>
                                                        {{$shop->page_name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id."_".$shop->page_name}} ">
                                                        {{$shop->page_name}}
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
                                    <label class="control-label mb-10">Choose Category<span
                                            class="text-danger font-16">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-shuffle"></i></span>
                                        </div>
                                        <select class="form-control" id="category_ids" name="category_ids" required>
                                            <option selected disabled>Select Category</option>
                                            @if($product_details !== null)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}"
                                                        {{$category->id == $product_details->category_id ? "selected" : ""}}>
                                                        {{$category->name}}
                                                    </option>
                                                @endforeach
                                                {{--@else
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach--}}
                                            @endif
                                        </select>
                                    </div>
                                    <label for="category_ids" class="error text-danger"></label>
                                    @if($errors->has('category_ids'))
                                        <p class="text-danger font-14">{{ $errors->first('category_ids') }}</p>
                                    @endif
                                </div>

                                @if($product_details != null)
                                    @if($product_details->variant_combination_ids == null || $product_details->variant_combination_ids == "")
                                        <div class="form-check mb-25">
                                            <label class="form-check-label">
                                                <input style="width:25px; height: 25px" type="checkbox"
                                                       class="form-check-input mt-0" name="specification_checkbox"
                                                       id="specification_checkbox">
                                                <span class="font-18 text-primary text-uppercase font-weight-900 ml-4">Product Specification</span>
                                            </label>
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
                                    @endif
                                @else
                                    <div class="form-check mb-25">
                                        <label class="form-check-label">
                                            <input style="width:25px; height: 25px" type="checkbox"
                                                   class="form-check-input mt-0" name="specification_checkbox"
                                                   id="specification_checkbox">
                                            <span class="font-18 text-primary text-uppercase font-weight-900 ml-4">Product Specification</span>
                                        </label>
                                    </div>

                                    <div id="specification_container">
                                        @foreach($variants as $variant)
                                            <div class="form-group">
                                                <label class="control-label mb-10">{{$variant->name}}<span
                                                        class="text-danger font-16">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="icon-shuffle"></i></span>
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
                                @endif


                                <label class="control-label mb-10">Product Images<span
                                        class="text-danger font-16">*</span></label>
                                <span class="text-muted font-12">[Max 1 MB | Max 5 images]</span>
                                <div class="input-images"></div>
                                {{--<div class="row">
                                   --}}{{-- <div class="col-sm-6" id="image_uploader_field">
                                        <input type="file" name="product_images[]" class="product_images image_files"
                                               multiple/>
                                    </div>--}}{{--

                                </div>
                                <hr>
                                <div class="row" style="padding: 20px !important;" id="image_preview_container">
                                    --}}{{-- <div class="col-sm-4 p-2">
                                         <img id="blah" src="{{asset('images/demo/1.jpeg')}}" style="max-width: 100%">
                                         <a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"
                                            style="right: 0;position: absolute;padding: 1px 7px;top:0px">X</a>
                                     </div>--}}{{--
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
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> {{ $product_details !== null ? "Update" : "Save" }}
                                        Product
                                    </button>
                                </div>
                                <br>
                                <input type="hidden" name="product_id"
                                       value="{{$product_details !== null ? $product_details->id : ""}}">

                                <input type="hidden" name="parent_product_id"
                                       value="{{$product_details !== null ? $product_details->parent_product_id : ""}}">

                                <input type="hidden" name="old_product_code"
                                       value="{{$product_details !== null ? $product_details->code : ""}}">
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            @if($product_details != null)
                @foreach($product_details->images as $image)
                    <input type="hidden" class="product_images"
                           value="{{$image->id .'__'.asset("images/products/". $image->image_url)}}">
                @endforeach
            @endif

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

    <script type="text/javascript" src="{{asset("assets/admin_panel/dist/js/image-uploader.min.js")}}"></script>
    <script>
        let preloaded_image = [];

        $(".product_images").each(function () {
            console.log($(this).val());

            let item = {};
            item ["id"] = $(this).val().split('__')[0];
            item ["src"] = $(this).val().split('__')[1];

            preloaded_image.push(item);
        });

        console.log(preloaded_image);

        $('.input-images').imageUploader({
            imagesInputName: 'product_images',
            maxFiles: 5,
            preloaded: preloaded_image,
            preloadedInputName: 'old_images',
        });

        function readURL(input) {
            for (let i = 0; i < input.files.length; i++) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    // $('#blah').attr('src', e.target.result);
                    $("#image_preview_container").append(image(e.target.result));
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

        function image(imageUrl) {
            return '<div class="col-6 col-sm-4 p-2">\n' +
                '<img src="' + imageUrl + '" style="max-width: 100%">' +
                '<a href="javascript:void(0)" class="btn-xs btn-danger remove_image_btn"' +
                'style="right: 0;position: absolute;padding: 1px 7px;top:0px">X</a>' +
                '</div>';
        }

        $(document).ready(function () {
            $('body').delegate('.product_images', 'change', function () {
                console.log(this);
                readURL(this);
                $(this).hide();
                let $newInput = $('<input type="file" name="product_images[]" class="product_images image_files" multiple/>');
                $("#image_uploader_field").append($newInput);
            });

            $("#specification_checkbox").on('click', function () {
                if (this.checked) {
                    $("#specification_container").show(500);
                } else {
                    $("#specification_container").hide(500);
                }
            });

            $("#specification_container").hide();

            $('#product_state').select2();

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

            $("body").delegate(".remove_image_btn", "click", function () {
                console.log($('.product_images'));
                $(this).parent().remove();
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
    <link type="text/css" rel="stylesheet" href="{{asset("assets/admin_panel/dist/css/image-uploader.min.css")}}">
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
