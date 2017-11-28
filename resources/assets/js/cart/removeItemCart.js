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
            console.log('removeProductHandler');
            const $el = $(e.target),
                $row = $el.parents('.js-row');

            console.log($row.data('id'));
            if($row.data('id').length > 1){
                this.removeProductItemMethod($row.data('id'));
            }
        });
    }

    removeProductItemMethod(rowId){
        this.delete({
            data: {rowId: rowId},
            url: this.apiDeleteProductItemUrl,
            success: response => {
                if(typeof response.deleteId != 'undefined'){
                    console.log(response.deleteId);
                    $('#'+response.deleteId).hide();
                    $('#cartTotal').html(response.total);
                    $('#cartTotal').data('total_sum', response.total);
                    alertify.log.error('Remove product form Cart');
                }else if(typeof response.html != 'undefined'){
                    $('.js-cart-content').html(response.html);
                }
            },
        });
    }

}
