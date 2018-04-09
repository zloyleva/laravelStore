import {ApiModule} from '../api';

export class SortProdutsModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: SortProdutsModule');

        this.onchangeSelectHandler();
        this.onblurSelectHandler();
    }

    onchangeSelectHandler(){
        $('#sort_products').on('change', (e) => {
            e.preventDefault();

            this.onchangeSelectMethod();
        })
    }

    onblurSelectHandler(){
        $('#sort_products').on('blur', (e) => {
            e.preventDefault();

            this.onchangeSelectMethod();
        })
    }

    onchangeSelectMethod(){
        console.log('onchangeSelectHandler');
        const $form = $('#sort_products_form');
        const url = window.location.search;

        const searchParams = new URLSearchParams(url);
        searchParams.delete("sort_products");

        if (url.indexOf('?') !== -1) {
            const searchArray = url.substr(1).split('&');
            for (let itemArray of searchArray) {
                console.log(itemArray);
                let item = itemArray.split('=');
                if (item[0] === 'sort_products') {
                    continue;
                }

                let inputField = document.createElement("input");
                inputField.type = "hidden";
                inputField.name = item[0];
                inputField.value = decodeURIComponent(item[1]);
                $form.append(inputField);
            }
        }

        $form.submit();
    }
}