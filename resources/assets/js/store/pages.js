import {ApiModule} from '../api';
import {CategoryModule} from './category';

export class PageModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: PageModule');

        this.category = new CategoryModule();

        this.data = {};
        this.apiUrl = '/api/store/addtocart';
        this.addProductToCartBtnHandler();
    };

    addProductToCart() {
        this.post({
            data: this.data,
            url: this.apiUrl,
            success: response => {

            },
        });
    };

    addProductToCartBtnHandler() {
        $('.js-add_to_cart').off('click').on('click', e => {
            const $el = $(e.target),
            $row = $el.parents('.js-row');
            this.data = {
                productId: $row[0].id,
                qty: $row.find('.products_quantity').val(),
            };
            
            console.log(this.data);
            this.addProductToCart();
        });
    };


}