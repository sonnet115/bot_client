<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Howkar Technology</title>

    <link href={{asset("assets/admin_panel/vendors/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet"
          type="text/css">
    <link href={{asset("assets/admin_panel/dist/css/style.css")}} rel="stylesheet" type="text/css">
    <style>
        body {
            /* The image used */
            background-image: url({{asset("images/bg.jpg")}});

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-12 col-sm-12 col-md-9 col-lg-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="text-center">
                        <img src="{{asset('images/logo.png')}}" style="max-width: 100px">
                    </div>
                    <p class="text-center text-muted" style="font-size: 20px">Welcome to Messenger Automation</p>
                    <hr>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary mb-3"><i
                            class="fa fa-facebook-official"></i> Continue with Facebook</a>
                    <p class="text-center text-muted" style="font-size: 15px">By continuing you accept
                        <a href="https://howkar.com/privacy" target="_blank" style="text-decoration: underline">terms &
                            conditions</a> of our service
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src={{asset("assets/admin_panel/vendors/jquery/dist/jquery.min.js")}}></script>

<!-- Bootstrap Core JavaScript -->
<script src={{asset("assets/admin_panel/vendors/popper.js/dist/umd/popper.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/bootstrap/dist/js/bootstrap.min.js")}}></script>
</body>
</html>
