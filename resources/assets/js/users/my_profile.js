import {ApiModule} from '../api';

export class MyProfileModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: MyProfileModule');

        this.initGeocomplete();
        this.formUsersDataValidationHandler();
        this.submitUserDataHandler();
    }

    formUsersDataValidationHandler() {
        let validationUsersName = function( value, element ) {
            return this.optional( element ) || !(/[^a-zA-Z]+/g.test( value ));
        };

        $.validator.addMethod("checkName", validationUsersName ,"Please enter the correct value. Only latin chars");
        //todo add cyrillic validation

        $('#usersData').validate({
            rules: {
                name: {
                    maxlength: 250,
                    minlength: 5,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    checkName: true
                },
                fname: {
                    maxlength: 250,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    checkName: true
                },
                lname: {
                    maxlength: 250,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    checkName: true
                },
                address: {
                    maxlength: 250,
                    minlength: 10,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                },
                phone: {
                    digits: true,
                    maxlength: 12,
                    minlength: 10,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                }
            }
        });
    };

    submitUserDataHandler(){
        $('#usersData').on('submit', e => {
            e.preventDefault();
            console.log('submitUserDataHandler');
            alertify.log.error('submitUserDataHandler');
        });
    }
}