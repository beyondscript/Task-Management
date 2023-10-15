import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import supervisors from './components/supervisors.vue';

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'manage-supervisors'){
	const app = createApp({})
	app.use(store)
	app.component('supervisors', supervisors)
	app.mount('#supervisors')
}
