import VueRouter from 'vue-router';
import Index from "./views/index";
import Servises from './views/servises';
import Blog from './views/blog';
import Single_Service from './views/single_service';
import {i18n} from "../i18n";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
        {
            path: '/servises',
            name: 'servises',
            component: Servises
        },
        {
            path: '/servises/landing',
            name: 'servises',
            component: Single_Service
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },
        {
            path: '/:lang',
            component: {
                template: '<router-view></router-view>'
            },
            beforeEnter: (to, from, next) => {
              const lang = to.params.lang;
                if (!['ru','en'].includes(lang))
                    return next('ru');
                if (i18n.locale !== lang) {
                    i18n.locale = lang;
                }
            },
            children: [{
                path: '',
                name: 'Index',
                component: Index
            }]
        }
    ]
});

export default router;
