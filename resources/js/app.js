

require('./bootstrap');

window.Vue = require('vue');
require('vue-multiselect/dist/vue-multiselect.min.css');


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('card-component', require('./components/Card.vue').default);
Vue.component('menu-container', require('./modules/menu/MenuContainer').default);


const app = new Vue({
    el: '#app',
});
