@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Add products</h1>
</div>
<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form id="updateProducts" class="" action="{{ route('admin.updateProducts')  }}" method="post">
                <div class="form-group">
                    <input id="updateProductsBtn" class="btn btn-primary" type="submit" value="Update products">
                </div>
            </form>
        </div>

    </div>
</div>
@stop
