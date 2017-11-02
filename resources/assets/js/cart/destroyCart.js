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
            data: {},
            url: this.apiDeleteCartUrl,
            success: response => {
                $('.js-cart-content').html(response.html);
            },
        });
    }

}
