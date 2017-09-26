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


}