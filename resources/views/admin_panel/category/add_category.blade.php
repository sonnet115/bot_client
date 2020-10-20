@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i
                    class="fa fa-plus"> {{$category_details!==null ? "Update Category" : "Add Category"}}</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            <form
                                action="{{$category_details!==null ? route('category.update') : route('category.store')}}"
                                method="post" id="discount_form">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Category Name<span
                                            class="text-danger">*</span></label>
                                    <span style="font-size: 12px"> [Max 20 characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                        <input type="text" id="category_name" name="category_name"
                                               placeholder="Enter Category Name" class="form-control"
                                               value="{{$category_details!==null ? $category_details->name : old('category')}}"
                                               required>
                                    </div>
                                    <label for="category" class="error text-danger"></label>
                                    @if($errors->has('category'))
                                        <p class="text-danger">{{ $errors->first('category') }}</p>
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
                                            @if($category_details !== null)
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id}}"
                                                        {{$shop->id == $category_details->shop_id ? "selected" : ""}}>
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

                                @if($category_details !== null)
                                    <input type="hidden" name="category_id"
                                           value="{{$category_details !== null ? $category_details->id : ""}}">
                                @endif

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i> {{$category_details!==null ? "Update" : "Store"}}
                                        Category
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

@section('category-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection

@section('category-css')
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
