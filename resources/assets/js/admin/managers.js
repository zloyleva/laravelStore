import {ApiModule} from '../api';

export class ManagersModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: ManagersModule');

        this.createManagerHandler();
    };

    createManagerHandler() {
        $('#createManagerBtn').off('click').on('click', e => {
            e.preventDefault();
            console.log('createManagerBtn');

            this.createManagerMethod();
        });
    };

    createManagerMethod(){

    }
}