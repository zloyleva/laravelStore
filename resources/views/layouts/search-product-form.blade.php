<div class="container js-search-product">
    <div class="row">
        <form id="js-searchProductForm"  action="{{route('store')}}" method="get">
            <div class="col-sm-12 col-md-4 col-lg-4 search-property">
                <label for="">Search by: </label>
                <select class="form-control"  name="inputData" id="inputData">
                    <option value="name">Name</option>
                    <option value="sku">SKU</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 search-input">
                <input id="inputName" name="name" type="text" class="form-control" placeholder="Enter name">
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 search-button">
                <button type="submit" class="btn btn-default btn-search">Search</button>
            </div>
        </form>
    </div>
</div>