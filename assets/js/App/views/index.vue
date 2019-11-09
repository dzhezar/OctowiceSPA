<template>
    <div class="wrapper">
        <navigation></navigation>
        <section id="top">
            <div class="main-text">
                <span>
                    <span>
                        <span>OctoWice</span>
                        {{ $t("main.octopus.professional") }}
                    </span>
                </span>
            </div>
            <div data-aos="fade-left" class="octopus">
                <img src="../../../images/осьминог.svg" alt="">
            </div>
            <div class="scroll-arrow">
                <a v-scroll-to="'#services'">
                    <i class="fas fa-3x fa-chevron-down"></i>
                </a>
            </div>
        </section>
        <section id="services" class="section_dark">
            <div class="services-wrapper">
                <div class="services_main-text">
                    {{ $t("main.categories.what_we_do") }}
                </div>
                <div class="services_cards-wrapper">
                    <div data-aos="flip-right" data-aos-delay="100" class="service-card" v-for="category in categories">
                        <div class="service-card_top">
                            <img class="service-card_top_icon" :src="'/images/'+category.icon" alt="">
                            <div class="service-card_top_text">
                                {{ category.translations[getLocale()].name }}
                            </div>
                        </div>
                        <div class="service-card_text">
                            {{ category.translations[getLocale()].description  }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper_button-wrapper">
                <div class="services-wrapper_button-wrapper_button">
                    <a href="#">{{ $t("main.categories.services") }}</a>
                </div>
                <div class="services-wrapper_button-wrapper_text">
                    {{ $t("main.categories.list") }}
                </div>
            </div>
        </section>
        <section class="section_light">
            <div class="bike-section_wrapper">
                <div class="bike-section_title">
                    {{ $t("main.bike.complex") }}
                </div>
                <div class="bike-section_bike">
                    <img src="../../../images/bike.png" alt="">
                </div>
                <div class="bike-section_text" >
                    <p>
                        {{ $t("main.bike.description") }}
                    </p>
                    <div>
                        <a>Заказать звонок</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="reasons" class="section_dark">
            <div class="reasons_title">
                {{ $t("main.choose_us.name") }}
            </div>
            <div class="reasons_text">
                {{ $t("main.choose_us.description") }}
            </div>
            <div class="reasons_card-wrapper">
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/coin.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        {{ $t("main.choose_us.price.name") }}
                    </div>
                    <div class="reasons_card_text">
                        {{ $t("main.choose_us.price.description") }}
                    </div>
                </div>
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/future.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        {{ $t("main.choose_us.it.name") }}
                    </div>
                    <div class="reasons_card_text">
                        {{ $t("main.choose_us.it.description") }}
                    </div>
                </div>
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/product.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        {{ $t("main.choose_us.product.name") }}
                    </div>
                    <div class="reasons_card_text">
                        {{ $t("main.choose_us.product.description") }}
                    </div>
                </div>
            </div>
        </section>
        <section id="contacts" class="section_light">
            <div class="contacts_title">
                <div>
                    {{ $t("main.contacts.name") }}
                </div>
                <div>
                    {{ $t("main.contacts.time") }}
                </div>
            </div>
            <div class="contacts-bar">
                <ul>
                    <li>
                        <div>
                            <i class="fas fa-2x fa-phone"></i>
                        </div>
                    </li>
                    <li>
                        +38(050)868-38-47<br> octowice@gmail.com
                    </li>
                    <li>
                        <div>
                            <i class="fas fa-2x fa-envelope"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="form-wrapper">
                <form @submit="sendMessage">
                    <input required v-model="name" :placeholder=" $t('main.contacts.form.name')">
                    <input required v-model="email" :placeholder=" $t('main.contacts.form.email')">
                    <textarea required rows="6" v-model="message" :placeholder=" $t('main.contacts.form.message')"></textarea>
                    <input type="submit" :value=" $t('main.contacts.form.submit')">
                </form>
            </div>
            <footer-nav></footer-nav>
        </section>
        <div class="fixed-buttons phone">
            <i class="fas fa-2x fa-phone"></i>
        </div>
        <div class="fixed-buttons arrow-up">
            <a v-scroll-to="'#top'">
                <i class="fas fa-2x fa-chevron-up"></i>
            </a>
        </div>
        <!--        <div>-->
        <!--            <p @click="setLocale('en')"><flag iso="us"></flag></p>-->
        <!--            <p @click="setLocale('ru')"><flag iso="ru"></flag></p>-->
        <!--        </div>-->
        <!--        <p>{{ $t('header.main') }}</p>-->
    </div>
</template>
<script>
    import navigation from '../components/navigation';
    import footerNav from '../components/footerNav';
    import axios from 'axios'
    export default {
        name: 'index',
        components: {
            navigation,
            footerNav,
        },
        data() {
            return {
                name: '',
                email: '',
                message: '',
                categories: [],
            }
        },
        methods: {
            sendMessage: function (e) {
                e.preventDefault();
                console.log(this.message);
            },
            getLocale(){
                return this.$i18n.locale;
            }
        },
        mounted() {
            axios
                .get('/api/get_categories?limit=3&project_limit=1')
                .then(response => (this.categories = response.data));
        }
    }
</script>
