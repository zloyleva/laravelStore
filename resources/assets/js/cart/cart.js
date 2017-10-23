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

        this.googleApiKey = 'AIzaSyCFTgptWkyzCm-Js4fLEz0X0R4H_NRtFtE';

        this.initGeocomplete();
    };

    initGeocomplete() {
        $.getScript('http://maps.googleapis.com/maps/api/js?key=' +
            this.googleApiKey + '&libraries=places', (data, textStatus, jqxhr) => {
            console.log(textStatus);
                $('#address').geocomplete();
            }
        );
    };

  }
