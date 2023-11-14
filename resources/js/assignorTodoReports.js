import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import assignortodoreports from './components/assignortodoreports.vue';

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
if(url_segment[3] === 'supervisor-home'){
	const app = createApp({})
	app.use(store)
	app.component('assignortodoreports', assignortodoreports)
	app.mount('#assignorTodoReports')
}