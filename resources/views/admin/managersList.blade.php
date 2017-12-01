@extends('layouts.index')

@section('content')
<div class="container">
    <h1 data-page="admin_managers">Managers list</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                        <tr>
                            <th class="js-column-order" data-column="id">Manager id</th>
                            <th class="js-column-order" data-column="flname">Manager name</th>
                            <th class="js-column-order" data-column="email">Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($managers as $manager)
                        <tr class="js-row" data-id="{{$manager->id}}">
                            <td class="js-id" data-row="{{$manager->id}}">{{$manager->id}}</td>
                            <td class="js-name"
                                data-row="{{$manager->name}}">{{$manager->name}}</td>
                            <td class="js-email" data-row="{{$manager->email}}">{{$manager->email}}</td>
                            <td>
                                <div class="form-group select-block">
                                    <select class="js-action form-control">
                                        <option hidden>Action</option>
                                        <option>Activate</option>
                                        <option>Deactivate</option>
                                        <option value="admin">Set as administrator</option>
                                        <option value="user">Set as user</option>
                                    </select>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
            <h2>Add new manager</h2>
            <form action="" id="addManagerForm">
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input name="name" type="email" class="form-control" id="InputName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="InputEmail">Email address</label>
                    <input name="email" type="email" class="form-control" id="InputEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <button id="createManagerBtn" type="button" class="btn btn-default">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
