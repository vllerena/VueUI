<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('assets/icons/icon-48x48.png')}}" />
    <title>AdminKit Demo</title>
{{--    <link rel="stylesheet" href="{{mix('/css/all.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/app.css')}}"></link>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script>
        (function () {
            window.Laravel = {
                csrfToken: '{{csrf_token()}}'
            }
        })()
    </script>
</head>
<body>
    <div id="app">
        @if(Auth::check())
            <mainapp :user="{{Auth::user()}}" :permission="{{Auth::user()->role->permission}}"></mainapp>
        @else
            <mainapp :user="false"></mainapp>
        @endif
    </div>
</body>
<script src="{{mix('/js/app.js')}}"></script>
<script src="{{asset('assets/app.js')}}"></script>
</html>
