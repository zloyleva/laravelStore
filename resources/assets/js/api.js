export class ApiModule {
    constructor() {
        console.log('ApiModule');

        this.apiToken = this.readCookie('API-TOKEN');
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
