

require('./bootstrap');

window.Vue = require('vue');

import store from './store';

import Vuetify from 'vuetify';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', require('./components/HeadComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('create-component', require('./components/CreateFormComponent.vue').default);
Vue.component('calender-component', require('./components/CalenderComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('master-component', require('./components/MasterComponent.vue').default);
Vue.component('alert-component', require('./components/AlertComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);
Vue.component('loading-component', require('./components/LoadingComponent.vue').default);

Vue.use(Vuetify)

import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'



const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        icons:{
            iconfont:'mdiSvg'
        }
    }),
    store,
});
