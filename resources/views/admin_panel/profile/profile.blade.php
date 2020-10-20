<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{{$title}}</title>
    <meta name="description" content="Messenger Automation System"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}">
    <link rel="icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}" type="image/x-icon">

    <link href={{asset("assets/admin_panel/vendors/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet"
          type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href={{asset("assets/admin_panel/dist/css/style.css")}} rel="stylesheet" type="text/css">
    <link href={{asset("assets/admin_panel/dist/css/custom.css")}} rel="stylesheet" type="text/css">
    <style>
        .select2-selection__choice {
            color: black !important;
            background: #cbcbcb !important;
        }

        .select2-selection__choice__remove {
            color: black !important;
        }

        td {
            font-size: 13px !important;
            color: black !important;
        }

        .hk-wrapper.hk-vertical-nav .hk-pg-wrapper {
            margin-left: 0 !important;
        }
    </style>
</head>

<body>
<!-- Preloader-->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);">
            <span class="feather-icon"><i data-feather="menu"></i></span>
        </a>
        <a class="navbar-brand font-weight-900 text-white" style="font-size: 30px !important;"
           href="#">Howkar Technology
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="{{auth()->user()->profile_picture}}" alt="user"
                                     class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{auth()->user()->name}}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="dropdown-icon zmdi zmdi-power"></i>
                        <span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /Top Navbar -->

    <!-- Main Content -->
    <div class="hk-pg-wrapper" style="margin-top: 35px">
        <div class="container mt-xl-30 mt-sm-30 mt-15">
            <!-- Title -->
            <div class="hk-pg-header align-items-top" style="margin:0 auto;max-width: 700px">
                <h2 class="hk-pg-title font-weight-700 mb-10 text-muted text-uppercase" style="margin-left: 10px"><i
                        class="fa fa-jsfiddle"> Approval Request</i>
                </h2>
            </div>
            <!-- /Title -->

            <!-- Row -->
            <div class="row">
                <div class="col-sm-12" style="margin:0 auto;max-width: 700px">
                    <section class="hk-sec-wrapper" style="padding-bottom: 20px">
                        <div class="row">
                            <div class="col-sm">
                                @if(Session::has('success_message'))
                                    <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success_message') }}</p>

                                @elseif ( auth()->user()->profile_completed == 1)
                                    <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">
                                        Your request is being processed. We will notify you within 1 hour.
                                        <br>
                                        <b style="font-size: 20px"> Thanks for your patience...</b>
                                    </p>

                                @elseif ( auth()->user()->profile_completed == 2)
                                    <p class="font-25 text-center text-success">
                                        <i class="fa fa-check-circle"></i> Congratulations !!!
                                    </p>
                                    <p class="font-20 text-center text-muted">Your profile has been approved</p>
                                    <hr>
                                    <div class="text-center">
                                        <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary btn-rounded">Goto
                                            Dashboard</a>
                                    </div>

                                @elseif(Session::has('error_message'))
                                    <p class="text-center alert {{ Session::get('alert-class', 'alert-danger') }}">
                                        {{ Session::get('error_message') }}
                                    </p>
                                    <div class="text-center">
                                        <a href="{{route('clients.profile')}}" class="btn btn-sm btn-danger">Try
                                            Again!</a>
                                    </div>

                                @else
                                    <form action="{{route('submit.for.approval')}}" method="post" novalidate>
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-10">Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                                </div>
                                                <input type="text" name="name" placeholder="Enter your name"
                                                       class="form-control"
                                                       value="{{auth()->user()->name}}"
                                                       required>
                                            </div>
                                            @if($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-10">Contact Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon-phone"></i></span>
                                                </div>
                                                <input type="text" name="contact"
                                                       placeholder="Enter your contact number"
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
        <!-- Footer -->
        <div class="hk-footer-wrap container">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Developed by
                            <a href="https://howkar.com/" class="text-dark" target="_blank">Howkar Technology</a> ©
                            2020-2021
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="d-inline-block">Follow us</p>
                        <a href="https://www.facebook.com/howkar.bd/"
                           class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                                class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- /Main Content -->
</div>
<!-- /HK Wrapper -->

<!-- jQuery -->
<script src={{asset("assets/admin_panel/vendors/jquery/dist/jquery.min.js")}}></script>

<!-- Bootstrap Core JavaScript -->
{{--<script src={{asset("assets/admin_panel/vendors/popper.js/dist/umd/popper.min.js")}}></script>--}}
<script src={{asset("assets/admin_panel/vendors/bootstrap/dist/js/bootstrap.min.js")}}></script>

<!-- FeatherIcons JavaScript -->
<script src={{asset("assets/admin_panel/dist/js/feather.min.js")}}></script>

{{--<!-- Init JavaScript -->--}}
<script src={{asset("assets/admin_panel/dist/js/init.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>
</body>
</html>
