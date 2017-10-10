
import {ApiModule} from '../api';

export class CategoryModule extends ApiModule {
    constructor() {
        super();
        console.log('Module: Category');

        this.init();
    };

    init(){
        const $categoryBox = $('#category_menu');
        $categoryBox.find('.active').parents('ul.sub_menu').addClass('display_item');
        console.log($categoryBox.find('.active') );
    }
}