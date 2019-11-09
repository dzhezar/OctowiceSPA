<template>
    <header data-aos="fade-down">
        <nav id='main-nav' class="navbar-expand-lg header">
            <div class="mobile-nav">
                <img src="../../../images/octo.png">
                <div style="display: flex; flex-flow: row wrap; font-size: x-large; margin-left: 1rem; place-content: center">Octowice</div>
            </div>
            <vue-scroll-progress-bar height=".25rem" background-color="#EB5757"></vue-scroll-progress-bar>
            <div class="header_wrapper">
                <div class="collapse navbar-collapse" id="navbarHeader">
                    <div class="navbar-nav">
                        <div class="contacts header-cnct">
                            <a href="tel:+38(050)868-38-47">+38(050)868-38-47</a><br>
                            <a href="mailto:octowice@gmail.com">octowice@gmail.com</a>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <router-link to="/">{{ $t("header.main") }}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/services">{{ $t("header.services") }}</router-link>
                            </li>
                            <li class="nav-item pt-0">
                                <img src="../../../images/octo.png" alt="">
                            </li>
                            <li class="nav-item">
                                <a href="#">{{ $t("header.portfolio") }}</a>
                            </li>
                            <li class="nav-item">
                                <router-link to="/blog">{{ $t("header.blog") }}</router-link>
                            </li>
                        </ul>
                        <div class="header-btn">
<!--                            <div @click="changeLocale">-->
                                <li v-if="this.$i18n.locale === 'ru'" class="nav-item">
                                    <p @click="setLocale('en')"><country-flag country="us"></country-flag></p>
                                </li>
                                <li v-else class="nav-item">
                                    <p @click="setLocale('ru')"><country-flag country='rus'/></p>
                                </li>
<!--                            </div>-->
                            <a href="#">Остались вопросы?</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <a class="menu-toggle rounded" id="menu-button" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-nav-item">
                    <img src="../../../images/octo.png">
                    <div style="display: flex; flex-flow: row wrap; font-size: x-large; margin-left: 1rem; place-content: center">Octowice</div>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link sidebar-link" href="#">Главная</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link sidebar-link" href="#">Услуги</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link sidebar-link" href="#">Портфолио</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link sidebar-link" href="#">Блог</a>
                </li>
            </ul>
        </nav>
    </header>
</template>
<script>
    import $ from 'jquery';
    import CountryFlag from 'vue-country-flag';
    export default {
        components: {
            CountryFlag
        },
        mounted() {
            $(document).ready(function () {
                $(".menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#sidebar-wrapper").toggleClass("active");
                    $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times").toggleClass("fa-bars fa-times");
                    $(".sidebar-nav-item").each(function (key,value) {
                        if(key === 0) {
                            $(this).toggleClass('fadeIn active animated');
                        }
                        else {
                            $(this).toggleClass('slideInRight active animated');
                        }
                    });
                    $(this).toggleClass("active");
                });
            });
        },
        methods: {
            setLocale(locale){
                $('body').fadeOut('fast');

                import(`../../locales/${locale}.json`).then((msgs) => {
                    this.$i18n.setLocaleMessage(locale,msgs);
                    this.$i18n.locale = locale
                });
                this.$i18n.locale = locale;
                $('body').fadeIn('1000');
                console.log($('body'));
            }
        }
    }
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            let nav = document.getElementById("main-nav");
            nav.style.background = "white";
            nav.style.boxShadow = "0 4px 10px 0 lightgray";
        } else {
            let nav = document.getElementById("main-nav");
            nav.style.background = "transparent";
            nav.style.boxShadow = "unset";
        }
    }
</script>

<style>

</style>
