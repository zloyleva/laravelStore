export class ApiModule {
    constructor() {
        console.log('ApiModule');

        this.apiToken = this.readCookie('API-TOKEN');
        this.googleApiKey = 'AIzaSyCFTgptWkyzCm-Js4fLEz0X0R4H_NRtFtE';

        // set Validation Messages
        this.requiredField = "Это поле обязательно для заполнения";
        this.minlengthField = "Вы ввели слишком мало символов";
        this.maxlengthField = "Вы ввели слишком много символов";
        this.emailField = "Проверьте правильность Вашего Email";
        this.equalToField = 'Пароли не совпадают!';
        this.digitsField = 'Неверный формат данных. Должны быть только цифры.';
        this.maxValueField = 'Вы ввели слишком большое число';
        this.minValueField = 'Вы ввели слишком маленькое число';

    };

    get (settings) {
        const api = this;
        $.ajax(Object.assign(this.ajaxSettings(), settings)).fail(function (e) {
            if (e.status === 401) {
                const failed = this;
                api.get({
                    success: () => {
                        api.apiToken = api.readCookie('API-TOKEN');
                        failed.headers.authorization = 'Bearer ' + api.apiToken;
                        $.ajax(failed);

                    },
                });
            }
        });
    };

    initGeocomplete() {
        $.getScript('http://maps.googleapis.com/maps/api/js?key=' +
            this.googleApiKey + '&libraries=places', (data, textStatus, jqxhr) => {
                console.log(textStatus);
                $('#address').geocomplete();
            }
        );
    };

    post(settings) {
      console.log(this.apiToken);
        this.get(Object.assign(settings, {type: 'post'}));
    };

    put(settings) {
        this.get(Object.assign(settings, {type: 'put'}));
    };

    delete(settings) {
        this.get(Object.assign(settings, {type: 'delete'}));
    };

    apiHeaders() {
        return {
            'authorization': 'Bearer ' + this.apiToken,
            'accept': 'application/json',
            'content-type': 'application/x-www-form-urlencoded',
            'cache-control': 'no-cache',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        };
    };

    ajaxSettings() {
        return {
            headers: this.apiHeaders(),
            type: 'get',
            dataType: 'json',
            data: {},
            url: this.apiUrl,
            beforeSend: () => {
            },
            success: () => {
            },
            error: () => {
            },
            retries: 1
        };
    };

    readCookie(name) {
            const nameEQ = encodeURIComponent(name) + "=";
            const cookieArray = document.cookie.split(';');

            for (let i = 0; i < cookieArray.length; i++) {
                let cookie = cookieArray[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1, cookie.length);
                }

                if (cookie.indexOf(nameEQ) === 0) {
                    return decodeURIComponent(cookie.substring(nameEQ.length, cookie.length));
                }
            }
            return null;
        };

}
