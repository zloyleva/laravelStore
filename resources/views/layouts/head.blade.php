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
</head>