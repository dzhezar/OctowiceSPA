<template>
    <div>
        <nav id='main-nav' class="navbar navbar-expand-lg header">
            <div class="row w-75 m-auto">
                <div class="collapse navbar-collapse justify-content-around" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <p class="logo">
                            +38(050)868-38-47<br>
                            octowice@gmail.com
                        </p>
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a href="#">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a href="#">Услуги</a>
                            </li>
                            <li class="nav-item pt-0">
                                <img src="../../../images/octo.png" alt="">
                            </li>
                            <li class="nav-item">
                                <a href="#">Портфолио</a>
                            </li>
                            <li class="nav-item">
                                <a href="#">Блог</a>
                            </li>
                            <li class="nav-item">
                                <p @click="setLocale('en')"><country-flag country="us"></country-flag></p>
                            </li>
                            <li class="nav-item">
                                <p @click="setLocale('ru')"><country-flag country='rus'/></p>
                            </li>
                        </ul>
                        <a class="header-btn" href="#">Остались вопросы?</a>
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
                    <a class="nav-link m-1 sidebar-link" href="#">Главная</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link m-1 sidebar-link" href="#">Услуги</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link m-1 sidebar-link" href="#">Портфолио</a>
                </li>
                <li class="sidebar-nav-item">
                    <a class="nav-link m-1 sidebar-link" href="#">Блог</a>
                </li>
            </ul>
        </nav>
    </div>
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
                    $(this).toggleClass("active");
                });
            });
        },
        methods: {
            setLocale(locale){
                import(`../../locales/${locale}.json`).then((msgs) => {
                    this.$i18n.setLocaleMessage(locale,msgs);
                    this.$i18n.locale = locale
                });
                this.$i18n.locale = locale;
                console.log(this.$i18n.locale);
            }
        }
    }
</script>
<style>

</style>
