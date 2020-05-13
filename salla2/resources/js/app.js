
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.axios = require('axios');
window.Vue = require('vue');
import Chat from 'vue-beautiful-chat'
import Swal from 'sweetalert2'
import VeeValidate from 'vee-validate'
import moment from 'moment'
import { Form, HasError, AlertError } from 'vform'
import VueProgressBar from 'vue-progressbar'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import GetTextPlugin from 'vue-gettext'
import translations from '../lang/translations.json'
Vue.use(Chat)
Vue.use(GetTextPlugin, {
    availableLanguages: {
        en_US: 'American English',
        es_AR: 'Arabic',
    },
    defaultLanguage: 'es_AR',
    languageVmMixin: {
        computed: {
            currentKebabCase: function () {
                return this.current.toLowerCase().replace('_', '-')
            },
        },
    },
    translations: translations,
    silent: true,
})
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    height:'5px'
}
Vue.use(VueProgressBar, options)
Vue.use(VeeValidate);
window.Swal = Swal;
window.Form = Form;
window.moment = moment;
window.vue2Dropzone = vue2Dropzone;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY')
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('products-lists', require('./components/products/ProductsLists.vue').default);
Vue.component('products-lists-edit', require('./components/products/ProductsListsEdit.vue').default);
Vue.component('products-lists', require('./components/products/ProductsLists.vue').default);
//Vue.component('chat-app', require('./components/chat/ChatApp.vue').default);
Vue.component('list-users', require('./components/ListUsers.vue').default);
Vue.component('order-list', require('./components/orders/OrderList.vue').default);
Vue.component('edit-order-list', require('./components/orders/edit/OrderList.vue').default);
//Vue.component('front-chat', require('./components/frontChat/chat.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
