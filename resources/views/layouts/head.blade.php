<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Дом канцелярии |
        @isset($header_title) {{$header_title or ''}} @endisset
        @empty($header_title) Интернет магазин канцелярии, школьной продукции, детских игрушек @endempty
    </title>

    <meta name="description"
          content="@isset($header_description){{$header_description or ''}}@endisset
          @empty($header_description)Интернет магазин канцелярии, школьной продукции, детских игрушек@endempty"
    >

@isset($og)
    <!-- Start Open Graph Meta data -->
        <meta property="og:title" content="{{$og['title']}}" />
        <meta property="og:type" content="article" />
        <meta property="og:description" content="{{$og['description']}}"/>
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{$og['image']}}" />
        <!-- End Open Graph Meta data -->
@endisset

@empty($og)
    <!-- Start Open Graph Meta data -->
        <meta property="og:title" content="Интернет магазин канцелярии, школьной продукции, детских игрушек" />
        <meta property="og:type" content="article" />
        <meta property="og:description" content="Самый крупный в Запорожье супермаркет канцелярии, школьной продукции, детских игрушек, сувениров, кожгалантереи, новогодних товаров, бижутерии"/>
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{url('/')}}/images_service/logo.png" />
        <!-- End Open Graph Meta data -->
@endempty

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-101879455-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- End Google Analytics -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P5QRTFB');</script>
    <!-- End Google Tag Manager -->
</head>