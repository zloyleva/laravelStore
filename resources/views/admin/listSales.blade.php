@extends('layouts.index')

@section('content')
<div class="container header_section">
    <h1>{{$pageName}}</h1>
    <div class="addUserSection">
        <a href="{{route('admin.sales.create')}}" class="btn btn-primary">Add new Sale</a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">

            @include('layouts.flash_messages')

            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                        <tr>
                            <th class="js-column-order" data-column="count">#</th>
                            <th class="js-column-order" data-column="id">ID</th>
                            <th class="js-column-order" data-column="arrival_date">Sales date</th>
                            <th class="js-column-order" data-column="created_at">Created</th>
                            <th class="js-column-order">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td data-count="{{$loop->iteration}}">{{$loop->iteration}}</td>
                                <td data-id="{{$sale->id}}">{{ $sale->id }}</td>
                                <td data-sales_date="{{$sale->sales_date}}">{{ $sale->sales_date }}</td>
                                <td data-created_at="{{$sale->created_at}}">{{ $sale->created_at }}</td>

                                <td><a href="{{route('admin.sales.index')}}/{{$sale->id}}/edit">Edit</a></td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$slidersList->links()}}</div>--}}
    </div>
</div>
@stop
