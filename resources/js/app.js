import './bootstrap';

import {createApp} from 'vue';
import router from './router.js';
import vue_pages from './components/vue_pages.vue';

let url_segment = window.location.href.split('/')
if(!(url_segment[3] === 'login' || url_segment[3] === 'register' || url_segment[3] === 'verify-email' || url_segment[3] === 'redirect-to-welcome' || url_segment[3] === 'reset-password' || url_segment[3] === 'confirm-password' || url_segment[3] === 'admin' || url_segment[3] === 'supervisor' || url_segment[3] === 'stuff')){
	const app = createApp({})
	app.component('vue_pages', vue_pages)
	app.use(router)
	app.mount('#vue_pages')
}