import {ApiModule} from '../api';

export class CartModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CartModule');

        this.submitBtnHandler();
        this.formValidationHandler();
    };

    submitBtnHandler(){
      $('#submitCart').off('click').on('click', () => {
        console.log('submitBtnHandler');
        if($('#create-order-form').valid()){
          $('#create-order-form').submit();
        }
      });
    }

    createOrder(){

    }

    formValidationHandler() {
        $('#create-order-form').validate({
            rules: {
                phone: {
                    maxlength: 255,
                    required: true
                },
                note:{
                  maxlength: 500,
                }
            }
        });
    };

  }
