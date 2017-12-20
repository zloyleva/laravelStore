    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 section_logo">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images_service/logo.png" alt="">
                    </a>
                    <h3 class="logo-description">Самый крупный в Запорожье супермаркет-склад канцелярии, школьной продукции, детских игрушек и новогодних товаров</h3>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 section_info">
                    <h4>Информация</h4>
                    <hr>
                    <div class="social-block">
                        <h4>Мы в соц сетях</h4>
                        <div class="social-links">
                            <a href="https://www.youtube.com/channel/UCOOea210zpznMtVYYwjn-DA"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-vk" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/dom.kancelyarii/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 section_contacts">
                    <h4>Контакты</h4>
                    <div>г. Запорожье,</div>
                    <div>ул. Деповская 72</div>
                    <hr>
                    <div><a href="tel:0617699545"><i class="fa fa-phone" aria-hidden="true"></i> (061) 769 95 45 /c 8:30 до 19:00/</a></div>
                    <div><a href="tel:0676180545"><i class="fa fa-mobile" aria-hidden="true"></i> (067) 618 05 45 /без выходных/</a></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-101879455-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-101879455-1');
    </script>

    </body>
</html>