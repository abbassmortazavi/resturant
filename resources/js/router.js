import Vue from 'vue';
import VueRouter from 'vue-router';
import MainApp from './components/MainApp';


//Admin Pages
import Home from './components/pages/Home';
import Tags from './admin/pages/Tags';
import Category from './admin/pages/Category';
import User from './admin/pages/Users';
import Login from './admin/pages/Login';

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
    {
        path: '/category',
        component: Category
    }, 
    {
        path: '/users',
        component: User
    }, 
    {
        path: '/login',
        component: Login
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;