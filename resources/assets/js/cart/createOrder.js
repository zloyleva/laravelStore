import {ApiModule} from '../api';

export class CreateOrderModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: CreateOrderModule');

        this.apisendDataUrl = '/orders/create';

        this.createOrderHandler();
        this.formValidationHandler();
    }

    createOrderHandler(){
        $('#submitCart').off('click').on('click', () => {
            console.log('createOrderHandler');
            if($('#create-order-form').valid()){
                console.log('valid');
                this.sendDataMethod();
            }
        });
    }

    sendDataMethod(){
        this.post({
            data: $('#create-order-form').serialize(),
            url: this.apisendDataUrl,
            success: response => {
                window.location.replace(response.redirectUrl);
            },
        });

    }

    formValidationHandler() {
        $('#create-order-form').validate({
            rules: {
                address: {
                    maxlength: 255,
                    required: true
                },
                phone: {
                    maxlength: 255,
                    required: true
                },
                note:{
                    maxlength: 1000,
                }
            }
        });
    };
}
