<template>
    <transition name="router-anim" enter-active-class="animated fadeIn faster" leave-active-class="animated fadeOut faster">
        <router-view :key="$route.fullPath"></router-view>
    </transition>
</template>

<script>
    import 'bootstrap';
    import 'animate.css';


    export default {
        methods: {
            setLocale(locale){
                import(`../locales/${locale}.json`).then((msgs) => {
                    this.$i18n.setLocaleMessage(locale,msgs);
                    this.$i18n.locale = locale
                });
                this.$i18n.locale = locale
            }
        }
    }
</script>

<style src="../../css/app.css"></style>
<style src="../../css/media-queries/app_responsive.css"></style>
<style>
    @import "https://use.fontawesome.com/releases/v5.8.1/css/all.css";
    @import "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";
</style>
