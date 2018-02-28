@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>{{$pageName}}</h1>
    </div>
    <div class="container m-b-10">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                {!! $categories !!}

            </div>
        </div>
    </div>
@stop