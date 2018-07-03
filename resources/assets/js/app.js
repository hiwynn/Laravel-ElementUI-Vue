/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('default-list', require('./components/DefaultList.vue'));
Vue.component('search-area', require('./components/SearchArea.vue'));
Vue.component('add-dialog', require('./components/AddDialog.vue'));
Vue.component('import-dialog', require('./components/ImportDialog.vue'));

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(ElementUI)

const app = new Vue({
    el: '#app'
});
