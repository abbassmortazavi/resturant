import Vue from 'vue';
import VueRouter from 'vue-router';
import Panel from './components/pages/Panel';
import Hooks from './components/pages/basic/Hooks';

Vue.use(VueRouter);

const routes = [
    {
        path: '/panel',
        component: Panel
    },

    // vue hooks
    {
        path: '/hooks',
        component: Hooks
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;