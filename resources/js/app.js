

require('./bootstrap');

window.Vue = require('vue');
require('vue-multiselect/dist/vue-multiselect.min.css');
import router from './router';
import ViewUI from 'view-design';


Vue.use(ViewUI);





// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-app', require('./components/MainApp.vue').default);


const app = new Vue({
    el: '#app',
    router
});
