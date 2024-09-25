import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import assigneetodos from './components/assigneetodos.vue';

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
if(url_segment[3] === 'stuff' && url_segment[4] === 'assigned-tasks'){
	const app = createApp({})
	app.use(store)
	app.component('assigneetodos', assigneetodos)
	app.mount('#assigneeTodos')
}