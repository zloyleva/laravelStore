import {ApiModule} from '../api';

export class CtaModule extends ApiModule {
    constructor() {
        super();
        console.log('Page: CtaModule');

        this.openCtaModalHandler();
        this.closeCtaModalHandler();
        this.hideCtaModalHandler();
        this.sendBtnHandler();
        this.checkForm();
    }

    openCtaModalHandler(){
        $('#cta_modal_open').off('click').on('click', e=>{
            e.preventDefault();
            console.log('Click: CtaModule');

            $('#modal_cta').addClass('open_modal');
        });
    }

    closeCtaModalHandler(){
        $('#close_modal').off('click').on('click', e=>{
            e.preventDefault();
            console.log('Click: CtaModule Close');

            this.cleanAndHideCtaModalHandler();
        });
    }

    hideCtaModalHandler(){
        $('#modal_cta').off('click').on('click', e=>{
            e.preventDefault();
            if(event.target == event.currentTarget){
                console.log('Click: CtaModule Close');

                this.cleanAndHideCtaModalHandler();
            }
        });
    }

    sendBtnHandler(){
        $('#sendCta').off('click').on('click', e => {
            e.preventDefault();
            console.log('sendBtnHandler');
            this.sendCtaMethod();
        })
    }

    sendCtaMethod(){

        if ($('#ctaForm').valid() ){
            console.log('valid Form');
            // $('#ctaForm').submit();
            this.post({
                data: $('#ctaForm').serialize(),
                url: 'api/send_cta',
                success: response => {
                    alertify.log.success('Значение поля успешно обновилось');
                }
            });
            this.cleanAndHideCtaModalHandler();
        }else {
            console.log('not valid Form');
        }
    }

    cleanAndHideCtaModalHandler(){

        $('#modal_cta').removeClass('open_modal');
        $('#ctaForm input[name="name"]').val('');
        $('#ctaForm input[name="phone"]').val('');
    }

    checkForm() {
        $('#ctaForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
                phone: {
                    required: true,
                    number: true,
                    rangelength: [10, 12],
                    normalizer: function (value) {
                        return $.trim(value);
                    }
                },
            },
            messages: {
                name: {
                    required: this.requiredField,
                    minlength: this.minlengthField
                },
                phone: {
                    rangelength: "Не верное количество символов в номере телефона",
                    number: "Вводите только цифры!",
                    required: this.requiredField,
                    minlength: this.minlengthField
                }
            }
        });
    };
}
