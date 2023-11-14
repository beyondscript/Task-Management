import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import todos from './components/todos.vue';

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
if(url_segment[3] === 'admin-manage-todos'){
	const app = createApp({})
	app.use(store)
	app.component('todos', todos)
	app.mount('#todos')
}
