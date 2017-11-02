import {ApiModule} from '../api';

export class AdminModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: AdminModule');

        this.data = {};
        this.apiUpdateUrl = '/admin/products';

        this.updateProductHandler();
    };


    updateProductHandler() {
        $('#updateProductsBtn').off('click').on('click', e => {
            e.preventDefault();
            console.log('updateProductHandler');
            this.updateProductMethod();
        });
    };

    updateProductMethod() {
        this.post({
            data: this.data,
            url: this.apiUpdateUrl,
            success: response => {
                alertify.log.success('Product ' + response.name + ' added to Cart');
            },
        });
    };
}