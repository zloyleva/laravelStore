import {ApiModule} from '../api';

export class CartModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CartModule');

        this.apiDeleteCartUrl = '/cart';
        this.apiDeleteProductItemUrl = '/cart/item';
        this.googleApiKey = 'AIzaSyCFTgptWkyzCm-Js4fLEz0X0R4H_NRtFtE';

        this.submitBtnHandler();//todo need AJAX method
        this.formValidationHandler();
        this.clearCartHandler();
        this.removeProductHandler();
        this.initGeocomplete();
    };

    removeProductHandler(){
        $('.js-remove-product').off('click').on('click', e => {
            console.log('removeProductHandler');
            const $el = $(e.target),
                $row = $el.parents('.js-row');

            console.log($row.data('id'));
            if($row.data('id').length > 1){
                this.removeProductItemMethod($row.data('id'));
            }
        });
    }

    removeProductItemMethod(rowId){
        this.delete({
            data: {rowId: rowId},
            url: this.apiDeleteProductItemUrl,
            success: response => {
                if(typeof response.deleteId != 'undefined'){
                    console.log(response.deleteId);
                    $('#'+response.deleteId).hide();
                    $('#cartTotal').html(response.total);
                }else if(typeof response.html != 'undefined'){
                    $('.js-cart-content').html(response.html);
                }
            },
        });
    }

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
                $('.js-cart-content').html(response.html);
            },
        });
    }

  }
