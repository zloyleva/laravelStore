<div class="container">
    <h1>Заказ</h1>
</div>
<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <dl class="dl-horizontal">
                <dt>Заказ #</dt>
                <dd>{{$order->id}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Статус заказа</dt>
                <dd>{{$order->status}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Дата создания</dt>
                <dd>{{$order->created_at}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Итогвая сумма</dt>
                <dd>{{$order->total}}грн</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Адрес доставки</dt>
                <dd>{{$order->address}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>Заметки</dt>
                <dd>{{$order->note}}</dd>
            </dl>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Название</th>
                    <th>К-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                </tr>
                </thead>

                <tbody>

                @foreach($order->orderListItems as $row)

                    <tr data-row_id="{{$row->rowId}}">
                        <td>{{$row->sku}}</td>
                        <td>
                            <p><strong>{{$row->name}}</strong></p>
                        </td>
                        <td>{{$row->qty}}</td>
                        <td>{{$row->price}}</td>
                        <td>{{$row->total}}</td>
                    </tr>

                @endforeach

                </tbody>

                <tfoot>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td>Итогвая сумма</td>
                    <td>{{$order->total}}грн</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>