import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import assigneetodoreports from './components/assigneetodoreports.vue';

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
if(url_segment[3] === 'home'){
	const app = createApp({})
	app.use(store)
	app.component('assigneetodoreports', assigneetodoreports)
	app.mount('#assigneeTodoReports')
}