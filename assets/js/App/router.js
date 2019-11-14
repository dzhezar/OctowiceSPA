import VueRouter from 'vue-router';
import Index from "./views/index";
import Services from './views/services';
import Blog from './views/blog';
import Single_Service from './views/single_service';
import Single_Blog from './views/single_blog';
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
            path: '/services',
            name: 'services',
            component: Services
        },
        {
            path: '/service/:slug',
            name: 'single_service',
            component: Single_Service
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },
        {
            path: '/blog/paragraph',
            name: 'single_blog',
            component: Single_Blog
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
    ],
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    },
});

export default router;
