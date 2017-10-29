import {ApiModule} from '../api';

export class UserPasswordModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: UserPasswordModule');

        this.apiUrlUdateUserPassword = '/api/my_profile/password';

        this.formUsersPasswordValidationHandler();
        this.submitUserPasswordHandler();
    }

    formUsersPasswordValidationHandler(){
        let validationUsersPassword = function (value, element) {
            return this.optional(element) || !(/[^a-zA-Z0-9]+/g.test(value));
        };

        $.validator.addMethod("checkPassword", validationUsersPassword, "Please enter the correct value. Only latin chars, numbers");

        $('#usersPassword').validate({
            rules: {
                password: {
                    maxlength: 50,
                    minlength: 6,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    checkPassword: true
                },
                password_confirmation: {
                    equalTo: "#password"
                },
            }
        });
    }

    submitUserPasswordHandler() {
        $('#usersPassword').on('submit', e => {
            e.preventDefault();

            if ($('#usersPassword').valid()) {
                this.sendUserFormPassword();
            }

            console.log('submitUserPasswordHandler');
        });
    }

    sendUserFormPassword() {
        console.log('sendUserFormData: ');
        this.post({
            data: $('#usersPassword').serialize(),
            url: this.apiUrlUdateUserPassword,
            success: response => {

            }
        });
    }
}