import Vue from 'vue';
import VueRouter from 'vue-router';
import Panel from './components/pages/Panel';

Vue.use(VueRouter);

const routes = [
    {
        path: '/panel',
        component: Panel
    }
];

const router = new VueRouter({
    routes
});

export default router;