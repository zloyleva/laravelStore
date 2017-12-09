import {ApiModule} from '../api';

export class ChangeItemAmountModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: ChangeItemAmountModule');

        this.apiAmountAddItemUrl = '/cart/add_item';
        this.apiAmountSubItemUrl = '/cart/sub_item';

        this.checkForm();
        this.changeAmountAddBtnHandler();
        this.changeAmountSubBtnHandler();
    }

    changeAmountAddBtnHandler(){
        $('.js-add-product').off('click').on('click', e => {
            console.log('changeAmount - Add');
            this.prepareDataHandler(e,this.apiAmountAddItemUrl,'add');
        });
    }

    changeAmountSubBtnHandler(){
        $('.js-sub-product').off('click').on('click', e => {
            console.log('changeAmount - Sub');
            this.prepareDataHandler(e,this.apiAmountSubItemUrl,'sub');
        });
    }

    prepareDataHandler(e,urlAction,action){
        const $el = $(e.target),
            $form = $el.closest('.js-item-form');

        let $qtyInput = $form.find('input.products_quantity');
        let $currentAmount = $qtyInput.val();
        console.log($qtyInput);

        if( ($currentAmount < 1 || ($currentAmount == 1 &&  action == 'sub') ) ){
            alertify.log.error('Значение не может быть меньше 1');
            return ;
        }

        switch (action){
            case 'add':
                $qtyInput.val(++$currentAmount);
                break;
            case ('sub'):
                $qtyInput.val(--$currentAmount);
                break;
            case ('set'):
                break;
        }

        this.changeAmountItemMethod($form,urlAction);
    }

    changeAmountItemMethod($form,urlAction){
        if($form.valid()){
            this.post({
                data: $form.serialize(),
                url: urlAction,
                success: response => {
                    alertify.log.success('Значение поля успешно обновилось');
                    $form.find('.products_quantity').val(response.item.qty);
                    $form.find('.td-sum').html( (response.item.price*response.item.qty).toFixed(2) );

                    $('#cartTotal').html( parseFloat(response.total).toFixed(2) + ' грн' );
                    $('#cartTotal').data('total_sum', response.total);
                },
            });
        }else {
            console.log('not valid');
        }
    }

    checkForm(){
        $('.js-item-form').each((index, form)=>{

            $(form).validate({
                rules: {
                    rowId: {
                        required: true,
                        minlength: 10
                    },
                    amount: {
                        required: true,
                        digits: true,
                        max: 10000,
                        min: 1,
                    },
                },
                ignore: [],
            });

        });
    }
}
