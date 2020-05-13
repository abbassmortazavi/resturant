import Vue from 'vue';
import VueRouter from 'vue-router';
import MainApp from './components/MainApp';


//project Pages
import Home from './components/pages/Home';
import Tags from './components/pages/Tags'

Vue.use(VueRouter);

const routes = [
    {
        path: '/home',
        component: Home
    },
    {
        path: '/tags',
        component: Tags
    },
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;