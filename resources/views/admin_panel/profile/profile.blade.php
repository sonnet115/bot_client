@extends("admin_panel.main")

@section('profile-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection


@section("main_content")
    <!-- Container -->
    <div class="container mt-xl-30 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <h2 class="hk-pg-title font-weight-700 mb-10 text-muted"><i class="fa fa-plus"> Basic Information</i>
            </h2>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-7">
                <section class="hk-sec-wrapper" style="padding-bottom: 0px">
                    <div class="row">
                        <div class="col-sm">
                            @if(Session::has('success_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>
                            @elseif ( auth()->user()->contact!= null)
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">Your
                                    request is being processed. Please wait ...</p>
                            @elseif(Session::has('error_message'))
                                <p class="text-center alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error_message') }}</p>
                            @else
                                <form action="{{route('submit.for.approval')}}" method="post" novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-10">Contact Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-phone"></i></span>
                                            </div>
                                            <input type="text" name="contact" placeholder="Enter your contact number"
                                                   class="form-control" value="{{old('contact')}}" required>
                                        </div>
                                        @if($errors->has('contact'))
                                            <p class="text-danger">{{ $errors->first('contact') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-home"></i></span>
                                            </div>
                                            <input type="text" name="email" placeholder="Enter your email"
                                                   class="form-control"
                                                   value="{{auth()->user()->email != null ? auth()->user()->email : old('email') }}"
                                                   required>
                                        </div>
                                        @if($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-10">Choose Pages</label>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-magnet"></i></span>
                                            </div>
                                            <select class="js-example-basic-multiple" name="pages[]"
                                                    multiple="multiple">
                                                <option disabled>Select shop</option>
                                                @foreach($shop_list as $shop)
                                                    <option value="{{$shop->id}}">
                                                        {{$shop->page_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('pages'))
                                            <p class="text-danger">{{ $errors->first('pages') }}</p>
                                        @endif

                                    </div>

                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary mr-10">
                                            <i class="fa fa-plus-circle"></i> Request for approval
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
@endsection

@section('user-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        $("form").submit(function () {

            let user_name = $('input[name=user_name]').val();
            let user_username = $('input[name=user_username]').val();
            let user_role = $('.js-example-basic-multiple').val();
            let user_password = $('input[name=user_password]').val();

            console.log(user_role);

            let user_name_error_message = $("#user_name_error_message");
            let user_username_error_message = $("#user_username_error_message");
            let user_role_error_message = $("#user_role_error_message");
            let user_password_error_message = $("#user_password_error_message");

            //alert(user_name_error_message);


            user_name_error_message.html("");
            user_username_error_message.html("");
            user_password_error_message.html("");
            user_role_error_message.html("");


            let error_count = 0;

            if (user_name === "") {
                user_name_error_message.html('name field is required');
                error_count++;
            }
            if (user_username === "") {
                user_username_error_message.html('username field is required');
                error_count++;
            }

            if (user_role.length === 0) {
                user_role_error_message.html('role field is required');
                error_count++;
            }

            if (user_password === "") {
                user_password_error_message.html('password field is required');
                error_count++;
            }

            if (error_count > 0) {
                return false;
            }

        });
    </script>
@endsection
