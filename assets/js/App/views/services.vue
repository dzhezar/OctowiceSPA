<template>
    <div class="wrapper">
        <navigation></navigation>
        <div style="height: 55vh;display: flex; animation: gradientBG 4s ease alternate infinite; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="color: black;font-size: 50px; font-weight: 800; width: 70%; margin: auto;-webkit-animation: text-flicker-in-glow 1s linear both; animation: text-flicker-in-glow 1s linear both;">
                Что мы делаем?
            </div>
        </div>
        <div style="background: linear-gradient(180deg, #131313 0%, #333333 100%); display: flex;">
            <div class="row m-auto" style="color: black;display: flex; justify-content: space-between; width: 85%;">
                <div class="col-3 my-lg-5 m-md-3 caption" style="background: #BDBDBD;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px" v-for="category in categories">
                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">
                        <img class="col-3" :src="'/images/'+category.icon" alt="">
                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">
                            {{ category.translations[getLocale()].name }}
                        </div>
                    </div>
                    <div style="display: flex;">
                        <div style="font-size: 22px; line-height: normal; text-align: justify; margin: 15% 2rem;">
                            {{ category.translations[getLocale()].description }}
                        </div>
                    </div>
                    <div style="position: absolute; bottom: 3%; right: 10%; font-weight: bold;">
                        <router-link :to="'/service/'+category.slug" style="color: black; text-decoration: none;">Подробнее ></router-link>
                    </div>
                </div>
<!--                <div class="col-3 my-lg-5 m-md-3" style="background: #BDBDBD; box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">-->
<!--                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">-->
<!--                        <img class="col-3" src="../../../images/shop.svg" alt="">-->
<!--                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">-->
<!--                            Интернет магазин-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div  style="font-size: 22px; line-height: normal; margin: 15% 2rem">-->
<!--                        - любимые всеми магазины, похожи на сайты каталоги, однако есть функция покупки-->
<!--                    </div>-->
<!--                    <div style="position: absolute; bottom: 3%; right: 10%; font-weight: bold;">-->
<!--                        <a style="color: black; text-decoration: none;" href="#">Подробнее ></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-3 my-lg-5 m-md-3" style="background: #BDBDBD; box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">-->
<!--                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">-->
<!--                        <img class="col-3" src="../../../images/card.svg" alt="">-->
<!--                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">-->
<!--                            Сайт-визитка-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div style="font-size: 22px; line-height: normal; margin: 15% 2rem">-->
<!--                        - идеальный тип сайта для отображения товаров или услуг методом каталога-->
<!--                    </div>-->
<!--                    <div style="position: absolute; bottom: 3%; right: 10%; font-weight: bold;">-->
<!--                        <a style="color: black; text-decoration: none;" href="#">Подробнее ></a>-->
<!--                    </div>-->
<!--                </div>-->
                <div style="width: 100%;background: #BDBDBD; box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px; margin: 3rem 0; position: relative;">
                    <div class="my-4" style="border-right: thick #EB5757 solid; display: flex; width: 90%; margin: auto;">
                        <img src="../../../images/octopus.svg" alt="">
                        <div style="width: 100%; text-align: end; font-size: x-large; display: flex; justify-content: flex-end; align-items: center; padding: 0 15px;">
                            Индивидуальный проект
                        </div>
                    </div>
                    <div style="font-size: 22px; line-height: normal; margin: 3rem auto; width: 90%;">
                        если вам нужно что-нибудь отличное от Интернет магазина, сайта визитка или landing страницы.
                    </div>
                    <div style="position: absolute; bottom: 5%; right: 5%; font-weight: bold;">
                        <a style="color: black; text-decoration: none;" href="#">Подробнее ></a>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 55vh; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255)); display: flex;place-content: center; flex-wrap: wrap;">
            <div style="background: #BDBDBD; height: 200px; margin: 50px 0; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 78%; position:relative;">
                <div class="row mx-4 my-4" style="border-right: thick #EB5757 solid">
                    <div class="col-3">
                        <img src="../../../images/creative.svg" alt="">
                    </div>
                    <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">
                        Дополнительные услуги
                    </div>
                </div>
                <div style="display: flex; place-content: center;">
                    <div style="font-size: 22px; line-height: normal; text-align: justify; margin: 2% 2rem">
                        Страница на которой перечень услуг которые можно купить отдельно, или же продлеваются здесь
                    </div>
                </div>
                <div style="position: absolute; bottom: 5%; right: 3%; font-weight: bold;">
                    <a style="color: black; text-decoration: none;" href="#">Подробнее ></a>
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
        name: 'servises',
        components: {
            navigation,
            footerNav,
        },
        data() {
            return {
                categories: [],
            }
        },
        methods: {
            getLocale(){
                return this.$i18n.locale;
            }
        },
        mounted() {
            axios
                .get('/api/get_categories?project_limit=1')
                .then(response => (this.categories = response.data));
        }
    }
</script>
