import {ApiModule} from '../api';

export class ManagersModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: ManagersModule');
        this.apiUpdateUrl = '/api/managers';
        this.createManagerHandler();
    };

    createManagerHandler() {
        $('#createManagerBtn').off('click').on('click', e => {
            e.preventDefault();

            this.createManagerMethod();
        });
    };

    createManagerMethod(){
        this.post({
            data: $('#addManagerForm').serialize(),
            url: this.apiUpdateUrl,
            success: response => {

            },
        });
    }
}