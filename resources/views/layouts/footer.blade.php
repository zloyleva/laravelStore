<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 section_logo">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images_service/logo.png" alt="">
                </a>
                <h3 class="logo-description">Самый крупный в Запорожье супермаркет канцелярии, школьной продукции,
                    детских игрушек, сувениров, кожгалантереи, новогодних товаров, бижутерии</h3>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 section_info">
                <h4>Информация</h4>
                <a href="{{ route('site_map') }}">Карта сайта</a>
                <hr>
                <div class="social-block">
                    <h4>Мы в соц сетях</h4>
                    <div class="social-links">
                        <a href="https://www.youtube.com/channel/UCOOea210zpznMtVYYwjn-DA" target="_blank"><i
                                    class="fa fa-youtube" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-vk" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/domkanc/" target="_blank"><i class="fa fa-facebook-official"
                                                                                       aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/dom.kancelyarii/" target="_blank"><i class="fa fa-instagram"
                                                                                                aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 section_contacts">
                <h4>Контакты</h4>
                <div>г. Запорожье, ул. Деповская 72</div>
                <div class="info-phones">
                    <a href="tel:0617699546"><i class="fa fa-phone" aria-hidden="true"></i> (061) 769 95 46</a>
                    <a href="tel:0676180545"><img src="{{ url('/') }}/images_service/kyivstar.png" alt=""> (067) 618 05
                        45</a>
                </div>
                <div class="works">
                    <div><b>Работаем:</b></div>
                    <div>
                        понедельник - суббота 9:00 - 19:00<br>
                        воскресенье 9:00- 17:00
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>

<div class="scale_image" id="scale_image">
    <div class="scale_image_content">
        <div class="control"><span id="close_scale_image">&times;</span></div>
        <img src="/images/39179.jpeg" alt="">
    </div>
</div>

<div class="modal_cta" id="modal_cta">
    <div class="modal_content">
        <div class="control"><span id="close_modal">&times;</span></div>
        <header>
            <h4>Для заказа обратного звонка введите свое имя и телефон</h4>
        </header>
        <form action="" id="ctaForm">
            <div class="form-group">
                <label for="inputName">Введите имя</label>
                <input name="name" type="text" class="form-control" id="inputName" placeholder="Имя">
            </div>
            <div class="form-group">
                <label for="inputPhone">Введите телефон</label>
                <input name="phone" type="tel" class="form-control" id="inputPhone" placeholder="Телефон">
            </div>
            <div class="form-group">
                <button id="sendCta" type="button" class="btn btn-cta">Отправить заявку</button>
            </div>
        </form>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101879455-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-101879455-1');
</script>

</body>
</html>