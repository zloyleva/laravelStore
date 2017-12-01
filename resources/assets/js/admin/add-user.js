import {ApiModule} from '../api';

export class AddUserModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: AddUserModule');

        this.apiUpdateUrl = '/api/users';
        this.createUserHandler();
    };

    createUserHandler() {
        $('#addUser').off('click').on('click', e => {
            e.preventDefault();
            console.log('createUserHandler');
            this.createUserMethod();
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
}
