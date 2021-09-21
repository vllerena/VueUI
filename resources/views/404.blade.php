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
    <style>
        .misc-wrapper {
            display : -webkit-box;
            display : -webkit-flex;
            display : -ms-flexbox;
            display :         flex;
            -webkit-flex-basis : 100%;
            -ms-flex-preferred-size : 100%;
            flex-basis : 100%;
            min-height : 100vh;
            width : 100%;
            -webkit-box-align : center;
            -webkit-align-items : center;
            -ms-flex-align : center;
            align-items : center;
            -webkit-box-pack : center;
            -webkit-justify-content : center;
            -ms-flex-pack : center;
            justify-content : center;
        }

        .misc-wrapper .misc-inner {
            position : relative;
            max-width : 750px;
        }

        .misc-wrapper .brand-logo {
            display : -webkit-box;
            display : -webkit-flex;
            display : -ms-flexbox;
            display :         flex;
            -webkit-box-pack : center;
            -webkit-justify-content : center;
            -ms-flex-pack : center;
            justify-content : center;
            position : absolute;
            top : 2rem;
            right : 2rem;
            margin : 0;
        }

        .misc-wrapper .brand-logo .brand-text {
            font-weight : 600;
        }

        @media (max-height: 625px) {
            .misc-wrapper .misc-inner {
                margin-top : 4rem;
            }
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="misc-wrapper">
                    <a class="brand-logo" href="#">
                        <h2 class="brand-text text-primary ms-1">Vuexy</h2>
                    </a>
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                            <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
                            <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p><a class="btn btn-primary mb-2 btn-sm-block" href="/">Back to home</a>
                            <img class="img-fluid" src="{{asset('theme/img/error.svg')}}" alt="Error page" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
