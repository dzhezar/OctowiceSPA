import VueRouter from 'vue-router';
import Index from "./views/index";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
    ]
});

export default router;
