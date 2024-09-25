import {createWebHistory, createRouter} from 'vue-router';
import pageNotFound from './components/errors/404.vue';

const routes = [
	{
		path: '/:pathMatch(.*)*',
		name: '404',
		component: pageNotFound
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

export default router