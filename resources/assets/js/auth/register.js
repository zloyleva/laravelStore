import {ApiModule} from '../api';
import {Facebook} from '../facebook';

export class RegisterModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: RegisterModule');

        new Facebook();

        this.registerBtnHandler();
        this.checkForm();
    };

    registerBtnHandler(){
        $('#registerBtn').off('click').on('click', e => {
           e.preventDefault();
            FB.AppEvents.logEvent("Register New user");
           this.registerMethod();
        });
    }

    registerMethod(){
        if($('#registerForm').valid()){
            $('#registerForm').submit();
        }else {
            console.log('not valid Form');
            alertify.log.error('Ошибка! Проверть данные, которые Вы ввели!');
        }
    }

    checkForm() {
        $('#registerForm').validate({
            rules: {
                userType: {
                    required: true,
                },
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
                    // email: true,
                    email: {
                        depends: function(element) {
                            console.log($(element).val().length);
                            return $(element).val().length > 0;
                        }
                    },
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
            errorPlacement: function(error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "userType") {
                    $("#insertErrorMessage").html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                userType: {
                    required: "Выберите тип покупателя",
                },
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