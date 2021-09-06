require('./bootstrap');

import Vue from 'vue';

Vue.component('file-upload-component', require('./components/FileUploadComponent.vue').default);
Vue.component('list-email-component', require('./components/ListEmailComponent.vue').default);

Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app',
});