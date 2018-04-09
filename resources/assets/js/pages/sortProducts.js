import {ApiModule} from '../api';

export class SortProdutsModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: SortProdutsModule');

        this.onchangeSelectHandler();
    }

    onchangeSelectHandler(){
        $('#sort_products').on('change', (e) => {
            console.log('onchangeSelectHandler');
            const changeValue = $(e.target).val();
            const $form = $('#sort_products_form');
            const url = window.location.search;

            const searchParams = new URLSearchParams(url);
            searchParams.delete("sort_products");
            for (let item of searchParams) {
                let inputField = document.createElement("input");
                inputField.type = "hidden";
                inputField.name = item[0];
                inputField.value = item[1];
                $form.append(inputField);
            }

            $form.submit();
        })
    }
}