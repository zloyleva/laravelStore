window.$ = window.jQuery = require('jquery');
console.log('App was loaded');

require('jquery-validation');
require('bootstrap');
require('geocomplete');

window.alertify = require('alertify-webpack');

const page = require('page');

import { PageModule } from './store/pages';
import { CartModule } from './cart/cart';
import { MyProfileModule } from './users/my_profile';

$(document).ready(() => {

  page('/store*', () => new PageModule());
  page('/cart', () => new CartModule());
  page('/my_profile', () => new MyProfileModule());

  page();
  page.stop();
});
