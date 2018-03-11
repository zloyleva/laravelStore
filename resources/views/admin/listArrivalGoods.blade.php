@extends('layouts.index')

@section('content')
<div class="container header_section">
    <h1>{{$pageName}}</h1>
    <div class="addUserSection">
        <a href="{{route('admin.arrival.create')}}" class="btn btn-primary">Add new Arrival</a>
    </div>
</div>

<script>

    var app = new Vue({
        el: '#app',
        data: {
            arrivals: [
                @foreach($arrivals as $arrival)
                    { id: "{{$arrival->id}}", arrival_date: "{{$arrival->arrival_date}}" },
                @endforeach
            ]
        }
    })

</script>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                        <tr>
                            <th class="js-column-order" data-column="count">#</th>
                            <th class="js-column-order" data-column="id">ID</th>
                            <th class="js-column-order" data-column="arrival_date">Arrival date</th>
                            <th class="js-column-order" data-column="created_at">Created</th>
                            <th class="js-column-order">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($arrivals as $arrival)
                            <tr>
                                <td data-count="{{$loop->iteration}}">{{$loop->iteration}}</td>
                                <td data-id="{{$arrival->id}}">{{ $arrival->id }}</td>
                                <td data-arrival_date="{{$arrival->arrival_date}}">{{ $arrival->arrival_date }}</td>
                                <td data-created_at="{{$arrival->created_at}}">{{ $arrival->created_at }}</td>

                                <td><a href="{{route('admin.arrival.index')}}/{{$arrival->id}}/edit">Edit</a></td>
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
