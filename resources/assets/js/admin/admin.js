import {ApiModule} from '../api';
import { ManagersModule } from './managers';

export class AdminModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: AdminModule');

        if($('h1').data('page') == 'admin_managers'){
            new ManagersModule();
        }

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