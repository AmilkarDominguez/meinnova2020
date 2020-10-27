

require('./bootstrap');

window.Vue = require('vue');



Vue.component('brand', require('./components/BrandComponent.vue').default);

const app = new Vue({
    el: '#app',
});
