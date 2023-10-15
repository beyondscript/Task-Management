import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import todoreports from './components/todoreports.vue';

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'admin-home'){
	const app = createApp({})
	app.use(store)
	app.component('todoreports', todoreports)
	app.mount('#todoReports')
}