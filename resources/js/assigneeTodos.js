import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import assigneetodos from './components/assigneetodos.vue';

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'assigned-todos'){
	const app = createApp({})
	app.use(store)
	app.component('assigneetodos', assigneetodos)
	app.mount('#assigneeTodos')
}