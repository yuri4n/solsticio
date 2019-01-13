require('./bootstrap');

window.Vue = require('vue');

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('index', require('./components/Index.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);

//Noticias
Vue.component('noticias', require('./components/Noticias.vue').default);
Vue.component('noticia', require('./components/Noticia.vue').default);
Vue.component('archivos', require('./components/Archivos.vue').default);
Vue.component('clasificados', require('./components/Clasificados.vue').default);

//Servicios
Vue.component('servicios', require('./components/Servicios/Servicios.vue').default);
Vue.component('salondejuntas', require('./components/Servicios/SalonDeJuntas.vue').default);
Vue.component('salonsocial', require('./components/Servicios/SalonSocial.vue').default);
Vue.component('bbq', require('./components/Servicios/Bbq.vue').default);

//Peticiones
Vue.component('peticiones', require('./components/Peticiones/Peticiones.vue').default);
Vue.component('generica', require('./components/Peticiones/Generica.vue').default);
Vue.component('parqueadero', require('./components/Peticiones/Parqueadero.vue').default);

Vue.component('censo', require('./components/Censo.vue').default);
Vue.component('pagos', require('./components/Pagos.vue').default);

const app = new Vue({
    el: '#app'
});
