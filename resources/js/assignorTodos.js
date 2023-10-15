import './bootstrap';

import {createApp} from 'vue';
import store from './store';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import assignortodos from './components/assignortodos.vue';

let url_segment = window.location.href.split('/')
if(url_segment[3] === 'manage-todos'){
	const app = createApp({})
	app.use(store)
	app.component('assignortodos', assignortodos)
	app.mount('#assignorTodos')
}
