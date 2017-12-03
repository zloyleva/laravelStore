import {ApiModule} from '../api';

export class AddUserModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: AddUserModule');

        this.apiUpdateUrl = '/api/users';
        this.createUserHandler();
        this.checkForm();
    };

    createUserHandler() {
        $('#addUser').off('click').on('click', e => {
            e.preventDefault();
            console.log('createUserHandler');
            if($('#addUserForm').valid()){
                this.createUserMethod();
            }else {
                console.log('not valid');
            }
        });
    };

    createUserMethod(){
        this.post({
            data: $('#addUserForm').serialize(),
            url: this.apiUpdateUrl,
            success: response => {
                console.log(response);
            },
        });
    }

    checkForm(){
        $('#addUserForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                fname: {
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                lname: {
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
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                role: {
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                price_type: {
                    required: true,
                    digits: true,
                    max: 10,
                    min: 1,
                },
                address: {
                    minlength: 5,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                phone: {
                    minlength: 5,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                manager_id: {
                    required: true,
                    digits: true,
                    max: 20,
                    min: 1,
                },
            },
        });
    }
}
