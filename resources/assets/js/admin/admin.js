import {ApiModule} from '../api';
import { ManagersModule } from './managers';
import { AddUserModule } from './add-user';

export class AdminModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: AdminModule');

        if($('h1').data('page') == 'admin_managers'){
            new ManagersModule();
        }
        if($('h1').data('page') == 'add_user'){
            new AddUserModule();
        }

    };

}