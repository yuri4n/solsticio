import Vue from 'vue';
import VueAuthenticate from 'vue-authenticate';
import VueAxios from 'vue-axios';
import axios from 'axios';
import 'es6-promise/auto';
import moment from 'moment'

Vue.prototype.moment = moment;

import Notifications from 'vue-notification';
import VueEditor from "vue2-editor";

Vue.use(VueEditor)
Vue.use(Notifications)
window.Vue = require('vue');

Vue.use(VueAxios, axios)
Vue.use(VueAuthenticate, {
  baseUrl: 'http://solsticio.local/api/',
})

require('./bootstrap');

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('index', require('./components/Index.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);

//Noticias
Vue.component('noticias', require('./components/Noticias.vue').default);
Vue.component('noticia', require('./components/Noticia.vue').default);
Vue.component('archivos', require('./components/Archivos.vue').default);
Vue.component('clasificados', require('./components/Clasificados.vue').default);
Vue.component('clasificado', require('./components/Clasificado.vue').default);

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

//Admin
Vue.component('adminnavbar', require('./components/Admin/AdminNavbar.vue').default);
Vue.component('adminindex', require('./components/Admin/AdminIndex.vue').default);
Vue.component('adminnoticias', require('./components/Admin/AdminNoticias.vue').default);
Vue.component('adminreservaciones', require('./components/Admin/AdminReservaciones.vue').default);
Vue.component('adminarchivos', require('./components/Admin/AdminArchivos.vue').default);
Vue.component('adminclasificados', require('./components/Admin/AdminClasificados.vue').default);
Vue.component('adminpeticiones', require('./components/Admin/AdminPeticiones.vue').default);
Vue.component('admincenso', require('./components/Admin/AdminCenso.vue').default);
Vue.component('adminusuarios', require('./components/Admin/AdminUsuarios.vue').default);
Vue.component('adminusuarioscompletos', require('./components/Admin/AdminUsuariosCompletos.vue').default);

Vue.component('login', require('./components/Auth/Login.vue').default);
Vue.component('register', require('./components/Auth/Register.vue').default);

const app = new Vue({
    el: '#app',
});
