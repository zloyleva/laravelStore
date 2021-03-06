import {ApiModule} from '../api';

export class LoginModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: LoginModule');

        this.loginBtnHandler();
        this.checkForm();
        this.submitLoginForEnter();
    };

    submitLoginForEnter(){
        $('#password').on('keypress', e=>{
            if (e.keyCode == 13) {
                console.log('enter');
                this.loginMethod();
            }
        });
    }

    loginBtnHandler(){
        $('#loginBtn').off('click').on('click', e => {
            e.preventDefault();

            this.loginMethod();
        })
    }

    loginMethod(){
        console.log('loginBtnHandler');
        if ($('#loginForm').valid() ){
            $('#loginForm').submit();
        }else {
            console.log('not valid Form');
        }
    }

    checkForm() {
        $('#loginForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }

                },
                password: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }

                },
            },
            messages: {
                name: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                password: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                }
            }
        });
    };

}