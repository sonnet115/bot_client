@extends("admin_panel.main")

@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-50 mt-lg-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase"><i
                    class="fa fa-plus"> Add Variant</i>
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
                            <form action="{{route('variant.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-10">Variant Name<span
                                            class="text-danger">*</span></label>
                                    <span style="font-size: 12px"> [Max 20 characters]</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-th-list "></i></span>
                                        </div>
                                        <input type="text" id="variant_name" name="variant_name"
                                               placeholder="Enter Variant Name" class="form-control"
                                               value="{{old('variant_name')}}" required>
                                    </div>
                                    <label for="category" class="error text-danger"></label>
                                    @if($errors->has('variant_name'))
                                        <p class="text-danger">{{ $errors->first('variant_name') }}</p>
                                    @endif
                                </div>
                                <p class="text-center text-uppercase text-primary font-weight-bold font-16">Variant
                                    Properties</p>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Prop. Name<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" name="prop_name[]"
                                                       placeholder="Example: XL, L, Red, Black..." class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Description</label>
                                            <div class="input-group">
                                                <input type="text" name="prop_desc[]"
                                                       placeholder="Example: 20cm, 40cm...." class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="variant_prop_container">
                                    {{--<div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Prop. Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="prop_name[]"
                                                           placeholder="Example: XL, L, Red, Black..."
                                                           class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Description</label>
                                                <div class="input-group">
                                                    <input type="text" name="prop_desc[]"
                                                           placeholder="Example: 20cm, 40cm...." class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <a href="javascript:void(0)" style="margin-top: 36px"
                                                       class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-times "></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>

                                <div class="text-right">
                                    <a id="add_more_field" href="javascript:void(0)"
                                       class="btn btn-outline-primary btn-rounded btn-sm text-right">Add More Field</a>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">
                                        <i class="fa fa-save"></i> Create Variant
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
            $("#add_more_field").on('click', function () {
                let new_item = $(propertyTemplate()).hide();
                $("#variant_prop_container").append(new_item);
                new_item.show(300);
            });

            $(document).on('click', '.remove_field', function () {
                let $target = $(this).parent().parent().parent().parent();
                $target.hide(500, function () {
                    $target.remove();
                });
            });
        });

        function propertyTemplate() {
            return '<div class="row">\n' +
                '                                        <div class="col-4">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="control-label mb-10">Prop. Name<span\n' +
                '                                                        class="text-danger">*</span></label>\n' +
                '                                                <div class="input-group">\n' +
                '                                                    <input type="text" name="prop_name[]"\n' +
                '                                                           placeholder="Example: XL, L, Red, Black..."\n' +
                '                                                           class="form-control"\n' +
                '                                                           required>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '\n' +
                '                                        <div class="col-6">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <label class="control-label mb-10">Description</label>\n' +
                '                                                <div class="input-group">\n' +
                '                                                    <input type="text" name="prop_desc[]"\n' +
                '                                                           placeholder="Example: 20cm, 40cm...." class="form-control"\n' +
                '                                                           >\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '\n' +
                '                                        <div class="col-2">\n' +
                '                                            <div class="form-group">\n' +
                '                                                <div class="input-group">\n' +
                '                                                    <a href="javascript:void(0)" style="margin-top: 36px"\n' +
                '                                                       class="btn btn-sm btn-outline-danger remove_field">\n' +
                '                                                        <i class="fa fa-times "></i>\n' +
                '                                                    </a>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>';
        }
    </script>
@endsection

@section('category-css')
    <link href="{{asset("assets/admin_panel/vendors/select2/dist/css/select2.min.css")}}" rel="stylesheet"
          type="text/css"/>
@endsection
