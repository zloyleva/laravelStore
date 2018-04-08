import {ProductImageScaleModule, ScaleImageModule, ScaleProductImageModule} from "./pages/scaleImage";

window.$ = window.jQuery = require('jquery');
console.log('App was loaded');

require('jquery-validation');
require('bootstrap');
require('geocomplete');
require('flexslider');

window.alertify = require('alertify-webpack');

const page = require('page');

import {PageModule} from './store/pages';
import {CartModule} from './cart/cart';
import {MyProfileModule} from './users/my_profile';
import {ManagersModule} from './admin/managers';
import {UserListModule} from './admin/users-list';
import {AddUserModule} from './admin/add-user';
import {EditUserModule} from './admin/edit-user';
import {LoginModule} from './auth/login';
import {RegisterModule} from './auth/register';
// import {AddNoteModule} from './admin/add-note';
import {ContactsModule} from './pages/contacts';
import {CtaModule} from './pages/CtaModule';
import {SliderModule} from './pages/slider';

$(document).ready(() => {

    page('/', () => new SliderModule());

    page('/login', () => new LoginModule());
    page('/register', () => new RegisterModule());

    page('/store*', () => new PageModule());
    page('/cart', () => new CartModule());
    page('/my_profile', () => new MyProfileModule());
    page('/contacts', () => new ContactsModule());

    page('/admin/managers', () => new ManagersModule());
    page('/admin/users', () => new UserListModule());
    page('/admin/users/:id/edit', () => new EditUserModule());
    page('/admin/users/create', () => new AddUserModule());
    page('/admin/notes/create', () => new AddNoteModule());

    page();
    page.stop();

    new CtaModule();
    // new Facebook();
});
