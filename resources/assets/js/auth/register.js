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
                fname: {
                    required: true,
                    minlength: 5,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                name: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                email: {
                    // required: true,
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
                },
                phone: {
                    required: true,
                    number: true,
                    rangelength: [10, 12],
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                address: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
            },
            messages: {
                fname: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                name: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                email: {
                    // required: this.requiredField,
                    email: this.emailField
                },
                password: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                password_confirmation: {
                    required: this.requiredField,
                    equalTo: this.equalToField
                },
                phone: {
                    rangelength: "Не верное количество символов в номере телефона",
                    number: "Вводите только цифры!",
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                address: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
            }
        });
    };
}