import {ApiModule} from '../api';

export class DestroyCartModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: DestroyCartModule');

        this.apiDeleteCartUrl = '/cart';
        this.clearCartHandler();
    }

    clearCartHandler(){
        $('#clearCart').off('click').on('click', () => {
            console.log('clearCartHandler');
            this.clearCartMethod();
        });
    }

    clearCartMethod(){
        this.delete({
            data: {
                user_ids: this.user_ids
            },
            url: this.apiDeleteCartUrl,
            success: response => {
                $('.js-cart-content').html('<div class="row empty-cart"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'+response.html+'</div></div>');
            },
        });
    }

}
