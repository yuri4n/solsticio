require('./bootstrap');

window.Vue = require('vue');

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('index', require('./components/Index.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);
Vue.component('noticias', require('./components/Noticias.vue').default);
Vue.component('noticia', require('./components/Noticia.vue').default);
Vue.component('archivos', require('./components/Archivos.vue').default);
Vue.component('clasificados', require('./components/Clasificados.vue').default);

const app = new Vue({
    el: '#app'
});
