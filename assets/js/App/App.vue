<template>
    <transition name="router-anim" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
        <router-view :key="$route.fullPath"></router-view>
    </transition>
</template>

<script>
    import 'bootstrap'
    import 'animate.css'
    import '@fortawesome/fontawesome-free/js/fontawesome'
    import '@fortawesome/fontawesome-free/js/solid'
    import '@fortawesome/fontawesome-free/js/regular'
    import '@fortawesome/fontawesome-free/js/brands'
    export default {
    }
</script>

<style src="../../css/app.css"></style>
