import {ApiModule} from '../api';

export class CreateOrderModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: CreateOrderModule');

        this.apisendDataUrl = '/orders/create';
        this.minOrderAmount = 200;

        this.createOrderHandler();
        this.formValidationHandler();
    }

    isCartAmountLessThanMin(){
        let total_sum = $('#cartTotal').data('total_sum') + "";
        if (parseInt(total_sum.replace(/,/ ,'')) < this.minOrderAmount ){
            return true;
        }else {
            return false;
        }
    }

    createOrderHandler(){
        $('#submitCart').off('click').on('click', () => {
            console.log('createOrderHandler');
            if(this.isCartAmountLessThanMin()){
                console.log('isCartAmountLessThanMin');
                Alertify.dialog.alert('Минимальная сумма заказа - 200 грн');
                return;
            }
            if($('#create-order-form').valid()){
                this.sendDataMethod();
                console.log('spiner');
                $('#loadToCreateOrder').addClass('create-order');
            }
        });
    }

    sendDataMethod(){
        this.post({
            data: $('#create-order-form').serialize(),
            url: this.apisendDataUrl,
            success: response => {
                if(response.redirectUrl){
                    $('#loadToCreateOrder').remove();
                    window.location.replace(response.redirectUrl);
                }
                //todo add broker order
            },
        });

    }

    formValidationHandler() {
        $('#create-order-form').validate({
            rules: {
                address: {
                    minlength: 5,
                    required: true
                },
                phone: {
                    maxlength: 13,
                    minlength: 10,
                    required: true
                },
                note:{
                    maxlength: 1000,
                }
            },
            messages: {
                address: {
                    minlength: this.minlengthField,
                    required: this.requiredField,
                },
                phone: {
                    minlength: this.minlengthField,
                    maxlength: this.maxlengthField,
                    required: this.requiredField,
                },
            }
        });
    };
}
