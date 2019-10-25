<template>
    <div class="wrapper">
        <navigation></navigation>
        <section id="top">
            <div class="main-text">
                <span>
                    <span>
                        <span>OctoWice</span>
                        digital agency
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
                    Что мы делаем?
                </div>
                <div class="services_cards-wrapper">
                    <div data-aos="flip-right" data-aos-delay="100" class="service-card">
                        <div class="service-card_top">
                            <img class="service-card_top_icon" src="../../../images/landing.svg" alt="">
                            <div class="service-card_top_text">
                                Landing Page
                            </div>
                        </div>
                        <div class="service-card_text">
                            одностраничный сайт отличается повышенной конверсией, меньшей информативностью по сравнению с другими сайтами
                        </div>
                    </div>
                    <div data-aos="flip-right" data-aos-delay="200" class="service-card">
                        <div class="service-card_top">
                            <img class="service-card_top_icon" src="../../../images/shop.svg" alt="">
                            <div class="service-card_top_text">
                                Интернет магазин
                            </div>
                        </div>
                        <div class="service-card_text">
                            любимые всеми магазины, похожи на сайты каталоги, однако есть функция покупки
                        </div>
                    </div>
                    <div data-aos="flip-right" data-aos-delay="300" class="service-card">
                        <div class="service-card_top">
                            <img class="service-card_top_icon" src="../../../images/card.svg" alt="">
                            <div class="service-card_top_text">
                                Сайт-визитка
                            </div>
                        </div>
                        <div class="service-card_text">
                            идеальный тип сайта для отображения товаров или услуг методом каталога
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper_button-wrapper">
                <div class="services-wrapper_button-wrapper_button">
                    <a href="#">Услуги</a>
                </div>
                <div class="services-wrapper_button-wrapper_text">
                    весь перечень услуг
                </div>
            </div>
        </section>
        <section class="section_light">
            <div class="bike-section_wrapper">
                <div class="bike-section_title">
                    Мы делаем сайты комплексно
                </div>
                <div class="bike-section_bike">
                    <img src="../../../images/bike.png" alt="">
                </div>
                <div class="bike-section_text" >
                    <p>
                    Если вы покупаете велосипед, то хотите сразу на нём поехать. Мы не продаем колёса отдельно от рамы. <br><br>
                    Вы делаете инвестицию в ваш бизнес, который будет полноценным. Дизайн, Сео, Верстка, поставить на наш хост. Всё это уже есть в стоимости пакета.
                    </p>
                    <div>
                        <a>Заказать звонок</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="reasons" class="section_dark">
            <div class="reasons_title">
                Почему стоит обратится к OctoWice?
            </div>
            <div class="reasons_text">
                Заказывая дешевый сайт у людей, которые только начинают развитие в сфере веб индустрии вы ставите под вопрос успешность вашего проекта. Из-за незнания мелочей и банальной неопытности вы рискуете потерять рейтинг в поисковике. Увеличение сложности продвижение, больше затрат на рекламу – вот что вас ждёт.<br><br>
                Заказав сайт у профессионалов, вы сразу же отделяете себя от этих проблем. Во-время работы над проектом вы получаете еженедельный отчёт по выполненной работе, то есть вам остается только проверить.
            </div>
            <div class="reasons_card-wrapper">
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/coin.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        Цена
                    </div>
                    <div class="reasons_card_text">
                        наших услуг < пользе которую они приносят
                    </div>
                </div>
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/future.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        Будущее за ИТ
                    </div>
                    <div class="reasons_card_text">
                        Будущее бизнеса кроется в интернете и качестве услуг
                    </div>
                </div>
                <div class="reasons_card">
                    <div class="reasons_card_img">
                        <img src="../../../images/product.svg" alt="">
                    </div>
                    <div class="reasons_card_title">
                        Продукт
                    </div>
                    <div class="reasons_card_text">
                        Мы уверены в своих силах и предоставляемых услугах
                    </div>
                </div>
            </div>
        </section>
        <section id="contacts" class="section_light">
        <div class="contacts_title">
                Наши контакты
            </div>
            <div class="contacts_subtitle">
                Свяжись с нами. Работаем с 10:00 - 19:00
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
                    <input required v-model="name" placeholder="Ваше имя">
                    <input required v-model="email" placeholder="Email">
                    <textarea required rows="6" v-model="message" placeholder="Ваше сообщение"></textarea>
                    <input type="submit" value="Отправить">
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
            }
        },
        methods: {
            sendMessage: function (e) {
                e.preventDefault();
                console.log(this.message);
            },
        }


    }
</script>
