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
                                action="{{$auto_reply_details!==null ? route('category.update') : route('category.store')}}"
                                method="post" id="discount_form">
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
                                            @if($auto_reply_details !== null)
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id}}"
                                                        {{$shop->id == $auto_reply_details->shop_id ? "selected" : ""}}>
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

                                @if($auto_reply_details !== null)
                                    <input type="hidden" name="category_id"
                                           value="{{$auto_reply_details !== null ? $auto_reply_details->id : ""}}">
                                @endif

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> {{$auto_reply_details!==null ? "Update" : "Save"}}
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
            $('#post_id').select2();
            $("#shop_id").on('change', function () {
                let shop_id = $(this).val();
                console.log(shop_id);
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
                        console.log(result);
                        let posts = "";
                        for (let i = 0; i < result.data.length; i++) {
                            if (result.data[i].message != null) {
                                posts += '<option value="' + result.data[i].id + '">' + result.data[i].message + '</option>';
                            }
                        }
                        console.log(posts);
                        $("#post_id").html(posts);
                        $(".preloader-it").hide();
                    },
                    error: function (xhr, status, error) {
                        $(".preloader-it").hide();
                    }
                });
            });
        });
    </script>
@endsection

@section('category-css')
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
        .select2-results__option{
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }
    </style>
@endsection
