import {ApiModule} from '../api';
import {CategoryModule} from './category';
import {SearchProductModule} from './searchProduct';
import {ProductImageScaleModule} from '../pages/scaleImage';

export class PageModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: PageModule');
        new ProductImageScaleModule();

        this.category = new CategoryModule();
        if ($('#js-searchProductForm').length > 0) {
            console.log('Page: has search product');
            new SearchProductModule();
        }

        this.data = {};
        this.apiUrl = '/api/store/addtocart';
        this.addProductToCartBtnHandler();
        this.checkForm();
    };

    checkForm() {
        $('form.addProductToCart').each((index, item) => {
            $(item).validate({
                rules: {
                    productId: {
                        digits: true,
                        max: 100000,
                        min: 1,
                        required: true
                    },
                    qty: {
                        digits: true,
                        max: 100000,
                        min: 1,
                        required: true
                    },
                },
                messages: {
                    productId: {
                        digits: this.digitsField,
                        max: this.maxValueField,
                        min: this.minValueField,
                        required: this.requiredField,
                    },
                    qty: {
                        digits: this.digitsField,
                        max: this.maxValueField,
                        min: this.minValueField,
                        required: this.requiredField,
                    }
                }
            });
        });
    }

    addProductToCart() {
        this.post({
            data: this.data,
            url: this.apiUrl,
            success: response => {
                alertify.log.success('Продукт ' + response.name + ' добавлен в корзину');
            },
        });

    };

    addProductToCartBtnHandler() {
        $('.js-add_to_cart').off('click').on('click', e => {
            if (this.apiToken == null) {
                Alertify.dialog.alert("<p>Для того чтобы положить товар в корзину</p>Вам необходимо войти в магазин</p>" +
                    "<a href='/login'>Перейти к странице входа <i class='fa fa-sign-in' aria-hidden='true'></i></a>");
                return;
            }

            const $el = $(e.target),
                $form = $el.closest('form.addProductToCart');
            this.data = $form.serialize();

            console.log(this.data);

            if ($form.valid()) {
                this.addProductToCart();
            } else {
                console.log('not valid');
            }

        });
    };


}