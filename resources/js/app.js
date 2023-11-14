import './bootstrap';

import {createApp} from 'vue';
import router from './router.js';
import vue_pages from './components/vue_pages.vue';

const app = createApp({})
app.component('vue_pages', vue_pages)
app.use(router)
app.mount('#vue_pages')
