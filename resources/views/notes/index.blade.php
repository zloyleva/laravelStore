@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Все записи</h1>
        <div class="addNoteSection">
            <a href="{{ route('admin.notes.create')  }}" class="btn btn-primary">Add new Note</a>
        </div>
    </div>
    <div class="container">
    @if( count($notes) > 0 )
        <table class="table table-bordered table-striped admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>News</th>
                <th>Shares</th>
                <th>Reviews</th>
                <th>Articles</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{$note->id}}</td>
                    <td>{{$note->title}}</td>
                    <td>
                        <input type="checkbox" disabled
                                @if($note->type_news)
                                    checked
                                @endif>
                    </td>
                    <td>
                        <input type="checkbox" disabled
                               @if($note->type_shares)
                               checked
                                @endif>
                    </td>
                    <td>
                        <input type="checkbox" disabled
                               @if($note->type_reviews)
                               checked
                                @endif>
                    </td>
                    <td>
                        <input type="checkbox" disabled
                               @if($note->type_articles)
                               checked
                                @endif>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div>
            Еще нет ни одной записи
        </div>
    @endif
    </div>
@stop