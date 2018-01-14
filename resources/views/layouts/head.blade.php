<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Дом канцелярии | {{$product->name or ''}}</title>

    @isset($og)
    <!-- Start Open Graph Meta data -->
    <meta property="og:title" content="{{$og['title']}}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{$og['description']}}"/>
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{$og['image']}}" />
    <!-- End Open Graph Meta data -->
    @endisset

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
    