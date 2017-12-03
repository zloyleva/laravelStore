import {ApiModule} from '../api';

export class ChangeItemAmountModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: ChangeItemAmountModule');

        this.apiAmountAddItemUrl = '/cart/add_item';
        this.apiAmountSubItemUrl = '/cart/sub_item';

        this.changeAmountAddBtnHandler();
        this.changeAmountSubBtnHandler();
    }

    changeAmountAddBtnHandler(){
        $('.js-add-product').off('click').on('click', e => {
            console.log('changeAmountAddBtnHandler');
            this.prepareDataHandler(e,this.apiAmountAddItemUrl,'add');
        });
    }

    changeAmountSubBtnHandler(){
        $('.js-sub-product').off('click').on('click', e => {
            console.log('changeAmountSubBtnHandler');
            this.prepareDataHandler(e,this.apiAmountSubItemUrl,'sub');
        });
    }

    prepareDataHandler(e,urlAction,action){
        const $el = $(e.target),
            $row = $el.parents('.js-row');
        let $currentAmount = $row.find('.products_quantity').val();

        if( ($currentAmount < 1 || ($currentAmount == 1 &&  action == 'sub') ) ){
            console.log('You enter wrong data');
            return ;//todo You enter wrong data
        }

        switch (action){
            case 'add':
                $currentAmount++;
                break;
            case ('sub'):
                $currentAmount--;
                break;
            case ('set'):
                break;
        }

        //todo check for sub method - if count = 1 return

        console.log($row.data('id'),action);
        this.changeAmountItemMethod($row.data('id'),urlAction,$currentAmount);
    }

    changeAmountItemMethod(rowId,urlAction,amount){
        this.post({
            data: {
                rowId: rowId,
                amount:amount
            },
            url: urlAction,
            success: response => {
                const $row = $('#'+response.item.rowId);
                $row.find('.products_quantity').val(response.item.qty);
                $row.find('.js-item-total').html( (response.item.price*response.item.qty).toFixed(2) );
                $('#cartTotal').html( parseFloat(response.total).toFixed(2) + ' грн' );
                $('#cartTotal').data('total_sum', response.total);
            },
        });
    }
}
