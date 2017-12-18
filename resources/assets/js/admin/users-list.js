import {ApiModule} from '../api';

export class UserListModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: UserListModule');

        this.selectUserHandle();
    };

    selectUserHandle() {
        $('.js-row.user-item').off('click').on('click', e => {
            // e.preventDefault();
            // const el = e.target;
            // const $row = $(el).closest('tr');

        });
    }
}