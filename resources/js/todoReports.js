import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import todoreports from './components/todoreports.vue';

axios.interceptors.response.use(
	response => response,
  	async(error) => {
		if(error.response.status === 500){
			localStorage.setItem('serverError', true)
			window.location.href = 'server-error'
		}
		return Promise.reject(error)
	}
)

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'admin-home'){
	const app = createApp({})
	app.use(store)
	app.component('todoreports', todoreports)
	app.mount('#todoReports')
}