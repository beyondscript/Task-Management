import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import assignortodos from './components/assignortodos.vue';

axios.interceptors.response.use(
	response => response,
  	async(error) => {
		if(error.response.status === 500){
			toastr.error('Something went wrong')
		}
		return Promise.reject(error)
	}
)

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'supervisor' && url_segment[4] === 'manage-tasks'){
	const app = createApp({})
	app.use(store)
	app.component('assignortodos', assignortodos)
	app.mount('#assignorTodos')
}
