window.$ = window.jQuery = require('jquery');
console.log('App was loaded');

require('jquery-validation');
require('bootstrap');

const page = require('page');

import { PageModule } from './store/pages';
import { CartModule } from './store/cart';

$(document).ready(() => {

  page('/store*', () => new PageModule());
  page('/cart', () => new CartModule());

  page();
  page.stop();
});
