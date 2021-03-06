import {ApiModule} from '../api';

export class UserDataModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: UserDataModule');

        this.apiUrlUdateUserData = '/api/my_profile/data';

        this.formUsersDataValidationHandler();
        this.submitUserDataHandler();
    }

    formUsersDataValidationHandler() {
        let validationUsersName = function (value, element) {
            return this.optional(element) || !(/[^a-zA-Zа-яА-Я]+/g.test(value));
        };

        $.validator.addMethod("checkName", validationUsersName, "Please enter the correct value. Only latin chars");
        //todo add cyrillic validation

        $('#usersData').validate({
            rules: {
                name: {
                    maxlength: 250,
                    minlength: 5,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    // checkName: true
                },
                fname: {
                    maxlength: 250,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    // checkName: true
                },
                lname: {
                    maxlength: 250,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    // checkName: true
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

    submitUserDataHandler() {
        $('#usersData').on('submit', e => {
            e.preventDefault();

            if ($('#usersData').valid()) {
                this.sendUserFormData();
                alertify.log.info("Changed user's data");
            }
        });
    }

    sendUserFormData() {
        console.log('sendUserFormData: ');
        this.post({
            data: $('#usersData').serialize(),
            url: this.apiUrlUdateUserData,
            success: response => {

            }
        });
    }
}