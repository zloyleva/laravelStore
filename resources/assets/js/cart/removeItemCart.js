import {ApiModule} from '../api';

export class RemoveItemCartModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: RemoveItemCartModule');

        this.apiDeleteProductItemUrl = '/cart/item';
        this.removeProductHandler();
    }

    removeProductHandler(){
        $('.js-remove-product').off('click').on('click', e => {
            const $el = $(e.target),
                $form = $el.closest('.js-item-form');

            if($form.valid()){
                console.log('removeProductHandler');
                this.removeProductItemMethod($form);
            }
        });
    }

    removeProductItemMethod($form){
        this.delete({
            data: $form.serialize(),
            url: this.apiDeleteProductItemUrl,
            success: response => {
                if(typeof response.deleteId != 'undefined'){
                    console.log(response.deleteId);
                    $form.closest('.table-row-cart').remove();

                    $('#cartTotal').html(response.total + " грн");
                    $('#cartTotal').data('total_sum', response.total);
                    alertify.log.error('Remove product form Cart');
                }else if(typeof response.html != 'undefined'){
                    $('.js-cart-content').html(response.html);
                }
            },
        });
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
