import {ApiModule} from '../api';
import {RemoveItemCartModule} from './removeItemCart';
import {DestroyCartModule} from './destroyCart';
import {ChangeItemAmountModule} from './changeItemAmountCart';

export class CartModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CartModule');

        new RemoveItemCartModule();
        new DestroyCartModule();
        new ChangeItemAmountModule();

        this.googleApiKey = 'AIzaSyCFTgptWkyzCm-Js4fLEz0X0R4H_NRtFtE';

        this.submitBtnHandler();//todo need AJAX method
        this.formValidationHandler();
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
                address: {
                    maxlength: 255,
                    required: true
                },
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
