import {ApiModule} from '../api';

export class CartModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CartModule');

        this.apiDeleteCartUrl = '/cart';
        this.googleApiKey = 'AIzaSyCFTgptWkyzCm-Js4fLEz0X0R4H_NRtFtE';

        this.submitBtnHandler();//todo need AJAX method
        this.formValidationHandler();
        this.clearCartHandler();
        this.initGeocomplete();
    };

    initGeocomplete() {
        $.getScript('http://maps.googleapis.com/maps/api/js?key=' +
            this.googleApiKey + '&libraries=places', (data, textStatus, jqxhr) => {
            console.log(textStatus);
                $('#address').geocomplete();
            }
        );
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
                console.log(response);
                $('.js-cart-content').html(response.message);
            },
        });
    }

  }
