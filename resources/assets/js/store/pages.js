import {ApiModule} from '../api';
import {CategoryModule} from './category';
import { SearchProductModule } from './searchProduct';

export class PageModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: PageModule');

        this.category = new CategoryModule();
        if($('#js-searchProductForm').length > 0){
            console.log('Page: has search product');
            new SearchProductModule();
        }

        this.data = {};
        this.apiUrl = '/api/store/addtocart';
        this.addProductToCartBtnHandler();
    };

    addProductToCart() {
        this.post({
            data: this.data,
            url: this.apiUrl,
            success: response => {
                alertify.log.success('Product ' + response.name + ' added to Cart');
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

            if(this.apiToken == null){
                Alertify.dialog.alert("You need to login for add product to cart</br><a href='/login'>Login Pls</a>");
                return;
            }

            this.addProductToCart();
        });
    };


}