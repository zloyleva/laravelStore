import {ApiModule} from '../api';

export class RegisterModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: RegisterModule');

        this.registerBtnHandler();
        this.checkForm();
    };

    registerBtnHandler(){
        $('#registerBtn').off('click').on('click', e => {
           e.preventDefault();
           this.registerMethod();
        });
    }

    registerMethod(){
        if($('#registerForm').valid()){
            $('#registerForm').submit();
        }else {
            console.log('not valid Form');
        }
    }

    checkForm() {
        $('#registerForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                email: {
                    required: true,
                    email: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    }

                },
                password: {
                    required: true,
                    minlength: 4,
                },
                password_confirmation: {
                    equalTo: "#password"
                }

            },
            messages: {
                name: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                email: {
                    required: this.requiredField,
                    email: this.emailField
                },
                password: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                password_confirmation: {
                    required: this.requiredField,
                    equalTo: this.equalToField
                }
            }
        });
    };
}