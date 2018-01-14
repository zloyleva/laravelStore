@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Создать запись</h1>
    </div>
    <div class="container">
        <div class="row">
            <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12" method="post" action="{{ route('admin.notes.store') }}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle">Title</label>
                    <input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title">
                </div>
                <div class="form-group">
                    <label for="inputThumbnail">Thumbnail</label>
                    <input type="file" id="inputThumbnail" placeholder="Thumbnail" name="thumbnail">
                    <p class="help-block">Select image for note's thumbnail</p>
                </div>
                <div class="form-group">
                    <label for="inputContent">Content</label>
                    <textarea class="form-control" id="inputContent" rows="3" placeholder="Content" name="content"></textarea>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="type_articles" checked value="1"> Article
                    </label>
                    <label>
                        <input type="checkbox" name="type_reviews" value="0"> Review
                    </label>
                    <label>
                        <input type="checkbox" name="type_shares" value="0"> Share
                    </label>
                    <label>
                        <input type="checkbox" name="type_news" value="0"> News
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@stop