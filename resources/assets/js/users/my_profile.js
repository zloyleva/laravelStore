import {ApiModule} from '../api';
import {UserDataModule} from './user_data';
import {UserPasswordModule} from './user_password';

export class MyProfileModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: MyProfileModule');

        new UserDataModule();
        new UserPasswordModule();

        this.initGeocomplete();
    }

}