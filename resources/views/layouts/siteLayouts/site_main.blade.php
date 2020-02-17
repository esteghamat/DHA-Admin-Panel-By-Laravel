<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digital Health Agency</title>
    <link rel="stylesheet" href="{{ asset('/frontend_assets/stylesheet/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/stylesheet/blogstyle.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets/stylesheet/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/stylesheet/swiper.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend_assets/dha-images/Vector Smart Object.png') }}">

</head>

@include ("layouts.siteLayouts.site_header")

@yield('content')

@include ("layouts.siteLayouts.site_footer" )        

</div>

<script src="{{ asset('frontend_assets/jsfiles/swiper.js') }}"></script>
<script src="{{ asset('frontend_assets/jsfiles/uikit.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('frontend_assets/jsfiles//app.js') }}"></script>

</body>

</html>