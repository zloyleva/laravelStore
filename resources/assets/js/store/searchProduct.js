import {ApiModule} from '../api';

export class SearchProductModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: SearchProductModule');

        this.selectInputData = $('#inputData').val();

        this.searchFormHandler();
        this.changeInputData();
    };

    searchFormHandler() {
        $('#js-searchProductForm').submit(e => {
            e.preventDefault();
            console.log('Enter submit');
            this.searchFormMethod();
        });
    };

    formValidationHandler() {
        console.log('formValidationHandler');
        $('#js-searchProductForm').validate({
            rules: {
                sku: {
                    digits: true,
                    max: 100000,
                    min: 1,
                    required: {
                        param: true,
                        depends: function(element) {
                            return $('#inputData').val() == 'sku';
                        }

                    }
                },
                name: {
                    maxlength: 255,
                    minlength: 3,
                    required: {
                        param: true,
                        depends: function(element) {
                            return $('#inputData').val() == 'name';
                        }

                    }
                },
            }
        });
    };

    changeInputData() {
        $('#inputData').change(e => {
            this.formValidationHandler();
            this.selectInputData = e.target.value;
            console.log(this.selectInputData);

            if (this.selectInputData == 'sku') {
                $('.search-input').html('<input id="inputSku" name="sku" type="text" class="form-control" placeholder="Enter SKU">');
                $('#inputName').remove();
            } else {
                $('#inputSku').remove();
                $('.search-input').html('<input id="inputName" name="name" type="text" class="form-control" placeholder="Enter name">');
            }
            $('#inputSku').val('');
            $('#inputName').val('');
            $('label.error').remove();
        });
    };

    searchFormMethod() {
        this.formValidationHandler();
        if ($('#js-searchProductForm').valid()) {
            console.log('SEARCH');
            this.getSearchData();
        }
    };

    getSearchData(){
        window.location.href = '//' + window.location.hostname + '/store/search?' + $('#js-searchProductForm').serialize();
    }
}