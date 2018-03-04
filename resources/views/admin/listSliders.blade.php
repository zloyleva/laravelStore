@extends('layouts.index')

@section('content')
<div class="container header_section">
    <h1>{{$pageName}}</h1>
    <div class="addUserSection">
        <a href="{{route('admin.sliders.create')}}" class="btn btn-primary">Add new Slide</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                    <tr>
                        <th class="js-column-order" data-column="count">#</th>
                        <th class="js-column-order" data-column="id">ID</th>
                        <th class="js-column-order" data-column="name">Slider name</th>
                        <th class="js-column-order" data-column="show_status">Show status</th>
                        <th class="js-column-order" data-column="text_title">Slider title</th>
                        <th class="js-column-order" data-column="created_at">Created</th>
                        <th class="js-column-order">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($slidersList as $item)
                        <tr>
                            <td data-count="{{$loop->iteration}}">{{$loop->iteration}}</td>
                            <td data-id="{{$item->id}}">{{$item->id}}</td>
                            <td data-user="{{$item->name}}">{{$item->name}}</td>
                            <td><input type="checkbox" @if($item->show_status) checked @endif disabled></td>
                            <td data-status="{{$item->text_title}}">{{$item->text_title}}</td>
                            <td data-created_at="{{$item->created_at}}">{{$item->created_at}}</td>

                            <td><a href="{{route('admin.sliders.index')}}/{{$item->id}}/edit">Edit</a></td>
                        </tr>
                        @empty
                            <td colspan="7">No slides yet</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$slidersList->links()}}</div>--}}
    </div>
</div>
@stop
