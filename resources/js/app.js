/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Swal from 'sweetalert2'

Vue.component('teacher-profile', require('./components/Teacher/Profile.vue').default)


Vue.use(VueAxios, axios);
window.Swal = Swal;

const app = new Vue({
    el: '#app',
});

