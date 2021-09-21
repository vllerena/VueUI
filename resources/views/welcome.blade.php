<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Layout Empty - Vuexy - Bootstrap HTML admin template</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/css/vertical-menu.css')}}">
    <script>
        (function () {
            window.Laravel = {
                csrfToken: '{{csrf_token()}}'
            }
        })()
    </script>
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <div id="app">
        @if(Auth::check())
            <mainapp :user="{{Auth::user()}}" :permission="{{(Auth::user()->role->permission) ? Auth::user()->role->permission : 'vacio'}}"></mainapp>
        @else
            <mainapp :user="false"></mainapp>
        @endif
    </div>
    <script src="{{mix('/js/app.js')}}"></script>
    <script src="{{asset('theme/js/vendors.min.js')}}"></script>
    <script src="{{asset('theme/js/app-menu.js')}}"></script>
    <script src="{{asset('theme/js/app.js')}}"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
</html>
