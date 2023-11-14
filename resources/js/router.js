import {createWebHistory, createRouter} from 'vue-router';
import pageNotFound from './components/errors/404.vue';
import serverError from './components/errors/500.vue';

const routes = [
	{
		path: '/:pathMatch(.*)*',
		name: '404',
		component: pageNotFound,
		meta: {
			isServerError: false
		}
	},
	{
		path: '/server-error',
		name: '500',
		component: serverError,
		meta: {
			isServerError: true
		}
	}
]
const router = createRouter({
	history: createWebHistory(),
	routes
})

router.beforeEach((to, from, next) => {
	if(to.meta.isServerError === true && !localStorage.getItem('serverError')){
		next({name: '404'})
	}
	else{
		next()
	}
})

export default router