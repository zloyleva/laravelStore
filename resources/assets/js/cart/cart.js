import {ApiModule} from '../api';
import {RemoveItemCartModule} from './removeItemCart';
import {DestroyCartModule} from './destroyCart';
import {ChangeItemAmountModule} from './changeItemAmountCart';
import {CreateOrderModule} from './createOrder';

export class CartModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CartModule');

        new RemoveItemCartModule();
        new DestroyCartModule();
        new ChangeItemAmountModule();
        new CreateOrderModule();

        this.initGeocomplete();
    };

  }
