@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Orders list</h1>
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
                        <th class="js-column-order" data-column="name">Username</th>
                        <th class="js-column-order" data-column="name">First and last name</th>
                        <th class="js-column-order" data-column="created_at">Created</th>
                        <th class="js-column-order" data-column="status">status</th>
                        <th class="js-column-order" data-column="manager">Manager</th>
                        <th class="js-column-order" data-column="price_type">Price type</th>
                        <th class="js-column-order" data-column="total">total</th>
                        <th class="js-column-order">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orderList as $item)
                        <tr>
                            <td data-count="{{$loop->iteration}}">{{$loop->iteration}}</td>
                            <td data-id="{{$item->id}}">{{$item->id}}</td>
                            <td data-user="{{$item->name}}">{{$item->name??"Незарегистрированный"}}</td>
                            <td>{{$item->fname}} {{$item->lname}}</td>
                            <td data-created_at="{{$item->created_at}}">{{$item->created_at}}</td>
                            <td data-status="{{$item->status}}">{{$item->status}}</td>
                            <td data-manager="{{$item->manager}}">{{$item->manager??"Неуказан"}}</td>
                            <td data-price_type="{{$item->price_type}}">{{$item->description??"Розничная"}}</td>
                            <td data-total="{{$item->total}}">{{$item->total}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-success" href="/admin/orders/{{$item->id}}">Детали</a>
                                    <a class="btn btn-danger" href="/admin/orders/{{$item->id}}/print">Отправить в 1С</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$orderList->links()}}</div>
    </div>
</div>
@stop
