import {AddUserModule} from './add-user';

export class EditUserModule extends AddUserModule {
    constructor() {
        super();
        console.log('Page: EditUserModule');

        this.apiUpdateUserUrl = '/api/users';
    };


    createUserHandler() {
        $('#addUser').off('click').on('click', e => {
            e.preventDefault();
            console.log('updateUserHandler');

            const user_id = $('#user_id').val();
            if(user_id > 0){
                this.apiUpdateUrl = '';
                this.apiUpdateUrl = this.apiUpdateUserUrl + '/' + user_id;
            }else {
                alertify.log.error('Ошибочные данные пользователя');
                return;
            }

            console.log(this.apiUpdateUrl);

            if($('#addUserForm').valid()){
                this.createUserMethod();
            }else {
                console.log('not valid');
            }
        });
    };
}