<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('font-awesome-4.3.0/css/font-awesome.css')}}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{asset('user-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('user-assets/css/style-responsive.css')}}" rel="stylesheet">
    @yield('link')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->

<div id="login-page">
    <div class="container">
        <form class="form-login" action="{{ route('login') }}" method="post">
            <h2 class="form-login-heading">sign in now</h2>
            <div class="login-wrap">
                @if(Session::has('error')){{ Session::get('error') }}@endif
                <input type="text" class="form-control" placeholder="Webmail ID" autofocus name="webmail" value="{{ Input::old('webmail') }}">
                <br>
                <input type="password" class="form-control" placeholder="Password" name="password">
                    <br>
                    <select class="form-control" name="server">
                        <option value="9">Naambor</option>
                        <option value="10">Disang</option>
                        <option value="11">Tamdil</option>
                        <option value="12">Teesta</option>
                        <option value="13">Dikrong</option>
                    </select>
                <label class="checkbox pull-right">
		                <input type="checkbox" name="remember">Remember Me
                </label>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
            </div>
        </form>

    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('user-assets/js/jquery.js') }}"></script>
<script src="{{ asset('user-assets/js/bootstrap.min.js') }}"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="{{ asset('user-assets/js/jquery.backstretch.min.js') }}"></script>
<script>
    $.backstretch("{{ asset('user-assets/img/login-bg.jpg') }}", {speed: 500});
</script>


</body>
</html>
