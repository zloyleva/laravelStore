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

//header actions
(function($) {

  var common = {
    options: {
      elms: {
        mega_dropdown: '.mega-dropdown',
        dropdown_menu: '.mega-dropdown-menu',
        nav: '.navbar__wrap',
        nav_bottom: '.navbar__bottom',
      },
      menu_scroll_delta: 160
    },
    init: function() {
      var _t = this,
        _o = _t.options;
      _t.bind();
      _t.checkHeaderPosition(0);
      _t.setMaxHeaderDropdownHeight();
    },
    bind: function() {
      var _t = this,
        _o = _t.options;
      // open menu by click
      $(document).on('click', _o.mega_dropdown, function(e) {
        e.stopPropagation()
      });

      $(window).on('scroll', function() {
        var offset = $(this).scrollTop();
        _t.checkHeaderPosition(offset);
      })
    },
    setMaxHeaderDropdownHeight: function() {
      var _t = this,
        _o = _t.options,
        wh = $(window).height(),
        ww = $(window).width(),
        nbh = $(_o.elms.nav_bottom).height(),
        max;
      if (ww > 1024) {
        max = wh - (nbh + 200);
        $(_o.elms.dropdown_menu).css({
          'max-height': max,
          'overflow-y': 'auto'
        });
      }
    },
    checkHeaderPosition: function(offset) {
      var _t = this,
        _o = _t.options;
      if (offset > _o.menu_scroll_delta) {
        $(_o.elms.nav).addClass('navbar__scrolled');
      } else {
        $(_o.elms.nav).removeClass('navbar__scrolled');
      }
    }
  };

  $(document).ready(function() {
    common.init();
  });

})(window.jQuery);
