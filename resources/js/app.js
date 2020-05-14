

require('./bootstrap');

window.Vue = require('vue');
require('vue-multiselect/dist/vue-multiselect.min.css');
import router from './router';

//View Ui
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);

//import Common js
import Common from './Common';
Vue.mixin(Common);



// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-app', require('./components/MainApp.vue').default);


const app = new Vue({
    el: '#app',
    router
});
