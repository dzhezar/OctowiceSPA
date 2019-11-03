<template>
    <div class="wrapper">
        <navigation></navigation>
        <div style="height: 55vh;display: flex; animation: gradientBG 4s ease alternate infinite; background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255))">
            <div style="color: black;font-size: 50px; font-weight: 800; width: 70%; margin: auto;-webkit-animation: text-flicker-in-glow 1s linear both; animation: text-flicker-in-glow 1s linear both;">
                Блог
            </div>
        </div>
        <div style="height: 125vh; background: linear-gradient(180deg, #131313 0%, #333333 100%); display:flex;">

            <div class="row m-auto" style="width: 85%; color: black; justify-content: center; align-content: center; height: 80vh;">
                <div style="background-color: rgb(196, 196, 196); padding: 5% 0;">
                    <div style="width: 85%; margin: auto; font-size: 40px; font-weight: 800; padding: 3% 0;">
                        Заголовок
                    </div>
                    <div style="width: 85%; margin: auto; font-size: 24px; line-height: normal; padding-bottom: 3%;">
                        Смысл жизни, следовательно, творит данный закон внешнего мира. Надстройка нетривиальна. Дискретность амбивалентно транспонирует гравитационный парадок
                    </div>
                    <div style="width: 85%; margin: auto; font-size: 20px; padding-bottom: 3%; display: flex;">
                        <div style="font-size: 16px;">
                            24/05/2019
                        </div>
                        <div style="width: 100%; text-align: end;">
                            <router-link to="/blog/paragraph" style="color: #EB5757; text-decoration: none;">Подробнее ></router-link>
                        </div>
                    </div>
                    <div style="height: 500px; background-color: rgb(0, 0, 0);width: 85%; margin: auto;">

                    </div>
                </div>
                <ul class="list-group list-group-horizontal" style="height: fit-content; padding-top: 3%;">
                    <li class="list-group-item" style="margin: 0 .5rem!important; background-color: #EB5757; color: white; font-weight: 800">1</li>
                    <li class="list-group-item" style="margin: 0 .5rem!important; background-color: #EB5757; color: white; font-weight: 800">2</li>
                    <li class="list-group-item" style="margin: 0 .5rem!important; background-color: #EB5757; color: white; font-weight: 800">3</li>
                    <li class="list-group-item" style="margin: 0 .5rem!important; background-color: #EB5757; color: white; font-weight: 800">4</li>
                </ul>
            </div>

        </div>
        <div style="background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%, rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%, rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%, rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%, rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%, rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%), linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(235, 87, 87, 0.16) 11%, rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%, rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%, rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%, rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%, rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%), linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%, rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%, rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%, rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%, rgba(235, 87, 87, 0.25) 83%, rgba(5, 5, 5, 0.03) 84%, rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%), linear-gradient(90deg, rgb(255, 255, 255), rgb(255, 255, 255)); display: flex;place-content: center; flex-wrap: wrap;">
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
    export default {
        name: 'blog',
        components: {
            navigation,
            footerNav,
        },
    }
</script>
