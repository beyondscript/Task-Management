import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import supervisors from './components/supervisors.vue';

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
if(url_segment[3] === 'admin' && url_segment[4] === 'manage-supervisors'){
	const app = createApp({})
	app.use(store)
	app.component('supervisors', supervisors)
	app.mount('#supervisors')
}
