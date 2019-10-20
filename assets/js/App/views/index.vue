<template>
    <div class="wrapper">
        <navigation></navigation>
        <div style="height: 100vh; animation: gradientBG 2s ease alternate forwards; background-size: 150% 100%; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
<!--        <div style="height: calc(100vh - 90px);background: linear-gradient(22.5deg, rgba(67, 67, 67, 0) 0%, rgba(255, 0, 0, 0) 29%, rgba(225, 32, 32, 0.09) 29%, rgba(173, 7, 7, 0.13) 37%, rgba(84, 61, 61, 0.07) 37%, rgba(23, 23, 23, 0) 55%, rgba(182, 182, 182, 0.05) 55%, rgba(255, 150, 150, 0.06) 69%, rgba(27, 27, 27, 0.02) 69%, rgba(27, 27, 27, 0.02) 71%, rgba(250, 250, 250, 0.02) 71%, rgba(250, 250, 250, 0.02) 100%), linear-gradient(67.5deg, rgba(117, 117, 117, 0.02) 0%, rgba(117, 117, 117, 0.02) 14%, rgba(199, 199, 199, 0.14) 14%, rgba(199, 199, 199, 0.02) 40%, rgba(33, 33, 33, 0.02) 40%, rgba(33, 33, 33, 0.02) 48%, rgba(135, 135, 135, 0.02) 48%, rgba(135, 135, 135, 0) 60%, rgba(148, 148, 148, 0) 60%, rgba(255, 202, 202, 0.28) 95%, rgba(53, 53, 53, 0) 95%, rgba(53, 53, 53, 0) 100%), linear-gradient(135deg, rgba(190, 190, 190, 0) 0%, rgba(190, 190, 190, 0) 6%, rgba(251, 251, 251, 0.02) 6%, rgba(251, 251, 251, 0.02) 18%, rgba(2, 2, 2, 0.02) 18%, rgba(2, 2, 2, 0.02) 27%, rgba(253, 253, 253, 0.02) 27%, rgba(253, 253, 253, 0.02) 49%, rgba(128, 128, 128, 0.02) 49%, rgba(128, 128, 128, 0.02) 76%, rgba(150, 150, 150, 0) 76%, rgba(128, 65, 65, 0) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255));">-->
            <div style="height: 70vh; display: flex;flex-wrap: wrap; align-items: center; width: 80%; margin: 0 auto; color: black; font-size: 50px;padding: 90px 15% 0 0; line-height: normal;">
                <span style="-webkit-animation: text-flicker-in-glow 2s linear both; animation: text-flicker-in-glow 2s linear both;">
                <span style="font-weight: bold">OctoWice</span> – закажи сайт у культурных профессионалов!
                </span>
            </div>
            <div style="height: 30vh; display: flex;flex-wrap: wrap; align-content: flex-end; justify-content: center; color: grey; padding-bottom: 20px;">
                <a href="#" v-scroll-to="'#id'" style="color: gray;">
                    <i class="fas fa-3x fa-chevron-down"></i>
                </a>
            </div>
        </div>
        <div id="id" style="height: 100vh; background: linear-gradient(180deg, #131313 0%, #333333 100%);">
            <div style="width: 100%; text-align: center; padding-top: 120px;font-weight: 900; font-size: 45px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif;">
                Что мы делаем?
            </div>
            <div class="row m-auto" style="padding-top: 6%; color: black;display: flex; justify-content: center">
                <div class="col-3 mx-lg-5 mx-md-3 caption" style="background: #BDBDBD; height: 450px;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">
                        <img class="col-3" src="../../../images/landing.svg" alt="">
                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">
                            Landing Page
                        </div>
                    </div>
                    <div style="font-size: 22px; line-height: normal; text-align: justify; margin: 20% 2rem;" class="caption_text">
                        - одностраничный сайт отличается повышенной конверсией, меньшей информативностью по сравнению с другими сайтами
                    </div>
                    <div class="caption_img">
                        <img style="width: 100%;" src="../../../велосипед.svg" alt="">
                    </div>
                </div>
                <div class="col-3 mx-lg-5 mx-md-3" style="background: #BDBDBD; height: 450px;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">
                        <img class="col-3" src="../../../images/shop.svg" alt="">
                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">
                            Интернет магазин
                        </div>
                    </div>
                    <div  style="font-size: 22px; line-height: normal; margin: 20% 2rem">
                        - любимые всеми магазины, похожи на сайты каталоги, однако есть функция покупки
                    </div>
                </div>
                <div class="col-3 mx-lg-5 mx-md-3" style="background: #BDBDBD; height: 450px;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="row mx-0 my-4" style="border-right: thick #EB5757 solid">
                        <img class="col-3" src="../../../images/card.svg" alt="">
                        <div class="col-9" style="font-size: x-large; display: flex; justify-content: flex-end; align-items: center;">
                            Сайт-визитка
                        </div>
                    </div>
                    <div style="font-size: 22px; line-height: normal; margin: 20% 2rem">
                        - идеальный тип сайта для отображения товаров или услуг методом каталога
                    </div>
                </div>
            </div>
            <div style="width: fit-content; text-align: center; font-weight: 700; font-size: 25px; margin: 4% auto 0; background: #EB5757; padding: 1rem 0; font-family: 'M PLUS 1p', sans-serif;">
                <a href="#" style="color: white; text-decoration: none; padding: 0 2rem;">Услуги</a>
            </div>
            <div style="width: fit-content; text-align: center; margin: 10px auto 0;">
                весь перечень услуг
            </div>
        </div>
        <div style="height: 100vh;background: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div class="row" style="height: 100%">
                <div class="col-12" style="width: 100%; text-align: center; padding-top: 120px;font-weight: 900; font-size: 50px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif; color: black;">
                    Мы делаем сайты комплексно
                </div>
                <div class="col">
                    <img src="../../../images/bike.png" style="height: 100%;" alt="">
                </div>
                <div class="col" style="color: black; font-size: 25px; display: flex; flex-wrap: wrap; place-content: center;">
                    <p style="width: 85%; line-height: normal;">
                    Если вы покупаете велосипед, то хотите сразу на нём поехать. Мы не продаем колёса отдельно от рамы. <br><br>
                    Вы делаете инвестицию в ваш бизнес, который будет полноценным. Дизайн, Сео, Верстка, поставить на наш хост. Всё это уже есть в стоимости пакета.
                    </p>
                    <div style="width: fit-content; text-align: center; font-weight: 700; color: white; font-size: 25px; margin: 50px auto 0; background: #EB5757; padding: 1rem 2rem; font-family: 'M PLUS 1p', sans-serif;">
                        Заказать звонок
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 100vh; background: linear-gradient(180deg, #131313 0%, #333333 100%);">
            <div style="width: 100%; text-align: center; padding-top: 140px;font-weight: 900; font-size: 45px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif;">
                Почему стоит обратится к OctoWice?
            </div>
            <div style="width: 85%;margin: auto; text-align: justify; padding-top: 50px; font-weight: 200; font-size: 25px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif;">
                Заказывая дешевый сайт у людей, которые только начинают развитие в сфере веб индустрии вы ставите под вопрос успешность вашего проекта. Из-за незнания мелочей и банальной неопытности вы рискуете потерять рейтинг в поисковике. Увеличение сложности продвижение, больше затрат на рекламу – вот что вас ждёт.<br><br>
                Заказав сайт у профессионалов, вы сразу же отделяете себя от этих проблем. Во-время работы над проектом вы получаете еженедельный отчёт по выполненной работе, то есть вам остается только проверить.
            </div>
            <div class="row" style="width: 80%; margin: auto; display: flex; flex-wrap: wrap; padding-top: 70px; color: black;">
                <div class="col mx-3" style="height: 350px; background: #BDBDBD;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="row">
                        <div class="col-12 text-center" style="padding-top: 80px">
                            <img src="../../../images/coin.svg" alt="" style="transform: scale(2)">
                        </div>
                        <div class="col-12 text-center" style="padding-top: 50px; font-size: x-large; font-weight: 800">
                            Цена
                        </div>
                        <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">
                            наших услуг < пользе которую они приносят
                        </div>
                    </div>
                </div>
                <div class="col mx-3" style="height: 350px; background: #BDBDBD; box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="col-12 text-center" style="padding-top: 80px">
                        <img src="../../../images/future.svg" alt="" style="transform: scale(2)">
                    </div>
                    <div class="col-12 text-center" style="padding-top: 50px; font-size: x-large; font-weight: 800">
                        Будущее за ИТ
                    </div>
                    <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">
                        Будущее бизнеса кроется в интернете и качестве услуг
                    </div>
                </div>
                <div class="col mx-3" style="height: 350px; background: #BDBDBD;box-shadow: rgba(0, 0, 0, 0.55) 4px 4px 10px 10px">
                    <div class="col-12 text-center" style="padding-top: 80px">
                        <img src="../../../images/product.svg" alt="" style="transform: scale(2)">
                    </div>
                    <div class="col-12 text-center" style="padding-top: 50px; font-size: x-large; font-weight: 800">
                        Продукт
                    </div>
                    <div class="col-10 text-justify m-auto" style="padding-top: 7%; font-size: large;">
                        Мы уверены в своих силах и предоставляемых услугах
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 100vh;background: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="width: 100%; text-align: center; padding-top: 120px;font-weight: 900; font-size: 45px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif; color: black">
                Наши контакты
            </div>
            <div style="width: 100%; text-align: center; padding-top: 15px; font-size: 16px; line-height: 100%;font-family: 'M PLUS 1p', sans-serif; color: black">
                Свяжись с нами. Работаем с 10:00 - 19:00
            </div>
            <div style="width: 75%; margin: 40px auto 0; line-height: 100%;font-family: 'M PLUS 1p', sans-serif; color: white; background: #333333; padding: 20px 0;">
                <ul class="list-group list-group-horizontal justify-content-center">
                    <li style="padding: .75rem 1.25rem; list-style: none">
                        <div style="height: 70px; width: 70px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center;">
                            <i class="fas fa-2x fa-phone"></i>
                        </div>
                    </li>
                    <li style="padding: .75rem 1.25rem; list-style: none; display: flex; place-items: center">
                        +38(050)868-38-47<br> octowice@gmail.com
                    </li>
                    <li style="padding: .75rem 1.25rem; list-style: none">
                        <div style="height: 70px; width: 70px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center;">
                            <i class="fas fa-2x fa-envelope"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <div style="width: 75%; margin: 40px auto 0; line-height: 100%;font-family: 'M PLUS 1p', sans-serif; color: black; padding: 20px 0 0;">
                <form @submit="sendMessage" class="row" style="place-content: center;">
                    <input class="col-6 text-center" style="width: 50%; height: 50px; margin: 0 1px 20px; padding: 5px 20px" v-model="name" placeholder="Ваше имя">
                    <input class="col-6 text-center" style="width: 50%; height: 50px; margin: 0 1px 20px; padding: 5px 20px" v-model="email" placeholder="Email">
                    <textarea required class="col-6 text-center" style="width: 50%;margin: 0 1px 20px; padding: 5px 20px;" rows="6" v-model="message" placeholder="Ваше сообщение"></textarea>
                    <input class="col-6 m-auto text-center" style="width: 50%; height: 50px; background: black; color: white; font-size: large; font-weight: 800" type="submit" value="Отправить">
                </form>
            </div>
            <footer-nav></footer-nav>
        </div>
        <div style="position: fixed; z-index: 1222; bottom: 2rem; left: 2rem; height: 70px; width: 70px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center;">
            <i class="fas fa-2x fa-phone"></i>
        </div>
        <div style="position: fixed; z-index: 1222; bottom: 2rem; right: 2rem; height: 50px; width: 50px; background-color: #EB5757; border-radius: 50%;display: flex; flex-wrap: wrap; place-content: center;">
            <i class="fas fa-2x fa-chevron-up"></i>
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
