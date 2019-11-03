<template>
    <div class="wrapper">
        <navigation></navigation>
        <div style="height: 55vh;display: flex; animation: gradientBG 4s ease alternate infinite; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="color: black;font-size: 50px; font-weight: 800; width: 70%; margin: auto;-webkit-animation: text-flicker-in-glow 1s linear both; animation: text-flicker-in-glow 1s linear both;">
                {{ category.translations[getLocale()].name }}
            </div>

        </div>
        <div style="height: 100vh; background: linear-gradient(180deg, #131313 0%, #333333 100%); display: flex;">
            <div class="row m-auto" style="color: black;display: flex; justify-content: center;">
                <div class="col-6" style="display: flex; place-content: center">
                    <img style="transform: scale(1.3);" :src="'/images/'+category.image" alt="">
                </div>
                <div class="col-6" style="display: flex;flex-direction: column; color: white;">
                    <div style="width: 80%; display: flex; justify-content: center; font-size: 40px; font-weight: bold; margin: auto; line-height: normal; text-align: center;">
                        Одной страницы достаточно?
                    </div>
                    <div style=" display: flex; flex-wrap: wrap; place-content: center; height: 100%">
                        <div style="font-size: 23px; width: 70%; margin: auto; line-height: normal;">
                            {{category.translations[getLocale()].long_description}}
                        </div>
                    </div>
                </div>
                <div class="col-12 mx-lg-5 mx-md-3" style="background: #BDBDBD;">

                </div>
            </div>
        </div>
        <div style="display: flex; flex-direction: column; animation: gradientBG 4s ease alternate infinite; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="color: black;font-size: 50px; padding-top: 5%; font-weight: 800; width: 70%; margin: auto;-webkit-animation: text-flicker-in-glow 1s linear both; animation: text-flicker-in-glow 1s linear both;">
                Что входит в тариф?
            </div>
            <div class="row" style="width: 85%; margin: auto; display: flex; flex-wrap: wrap; padding: 4% 0; color: black;">
                <div class="col mx-5" style="background: #BDBDBD; padding: 2% 0" v-for="service in category.services">
                    <div class="row">
                        <div class="col-12 text-center" style="padding-top: 20%">
                            <img :src="'/images/'+service.image" alt="" style="transform: scale(2)">
                        </div>
                        <div class="col-12 text-center" style="padding-top: 15%; font-size: x-large; font-weight: 800">
                            {{ service.translations[getLocale()].name }}
                        </div>
                        <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">
                            {{ service.translations[getLocale()].description }}
                        </div>
                    </div>
                </div>
<!--                <div class="col mx-5" style="background: #BDBDBD; padding: 2% 0">-->
<!--                    <div class="col-12 text-center" style="padding-top: 20%">-->
<!--                        <img src="../../../images/future.svg" alt="" style="transform: scale(2)">-->
<!--                    </div>-->
<!--                    <div class="col-12 text-center" style="padding-top: 15%; font-size: x-large; font-weight: 800">-->
<!--                        Будущее за ИТ-->
<!--                    </div>-->
<!--                    <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">-->
<!--                        Будущее бизнеса кроется в интернете и качестве услуг-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col mx-5" style="background: #BDBDBD; padding: 2% 0">-->
<!--                    <div class="col-12 text-center" style="padding-top: 20%">-->
<!--                        <img src="../../../images/product.svg" alt="" style="transform: scale(2)">-->
<!--                    </div>-->
<!--                    <div class="col-12 text-center" style="padding-top: 15%; font-size: x-large; font-weight: 800">-->
<!--                        Продукт-->
<!--                    </div>-->
<!--                    <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">-->
<!--                        Мы уверены в своих силах и предоставляемых услугах-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        <div style="background: linear-gradient(180deg, #131313 0%, #333333 100%); display: flex; font-size: 22px; padding: 2% 6%; place-content: center">
            Цены рассчитываются с учётом всех необходимых комлектующих сайта для его жизни. Сайт попадает в мир полноценным.
        </div>
        <div style="display: flex; flex-direction: column; animation: gradientBG 4s ease alternate infinite; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="display: flex; place-content: center; font-size: 50px; font-weight: bold; color: black; padding: 5%;">
                Какая же цена?
            </div>
            <div style="display: flex; width: 70%; margin: auto; background: #BDBDBD; border-left: thick solid red; padding: 5%;">
                <div style="width: 70%; display: flex; flex-wrap: wrap; place-content: center; font-size: 24px;">
                    Пора начать свой бизнесс быстрее - оставь заявку и от 2 недель получи полностью рабочий проект.
                </div>
                <div style="width: 30%; display: flex; flex-direction: column; place-content: center; text-align: center">
                    <div style="font-size: 40px; font-weight: bold; margin: 5% 0 2%;">
                    От {{category.price}}$
                    </div>
                    <div style="color: black;">
                        6.000 грн.
                    </div>
                    <a href="#" style="background: red; width: fit-content; margin: 4% auto; padding: 3%; font-size: 20px; font-weight: bold; color: white; text-decoration: none;">
                        Оставить заявку
                    </a>
                </div>

            </div>
            <footer-nav></footer-nav>
        </div>

        <div style="position: fixed; bottom: 2rem; left: 2rem; height: 70px; width: 70px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center; z-index: 1001;">
            <i class="fas fa-2x fa-phone"></i>
        </div>
        <div style="position: fixed; bottom: 2rem; right: 2rem; height: 50px; width: 50px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center; z-index: 1001;">
            <i class="fas fa-2x fa-chevron-up"></i>
        </div>
    </div>
</template>
<script>
    import navigation from '../components/navigation';
    import footerNav from '../components/footerNav';
    import axios from 'axios';

    export default {
        name: 'single_service',
        components: {
            navigation,
            footerNav,
        },
        data() {
            return {
                slug: this.$route.params.slug,
                category: []
            }
        },
        methods: {
            getLocale(){
                return this.$i18n.locale;
            }
        },
        mounted() {
            axios
                .get('/api/get_category?slug='+this.slug)
                .then(response => (this.category = response.data));
        }
    }
</script>
