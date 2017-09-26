window.$ = window.jQuery = require('jquery');
console.log('App was loaded');

require('jquery-validation');
require('bootstrap');

const page = require('page');

import { PageModule } from './store/pages';

$(document).ready(() => {

    page('/store*', () => new PageModule());

    page();
    page.stop();
});