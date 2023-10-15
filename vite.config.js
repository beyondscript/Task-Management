import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/supervisors.js',
                'resources/js/assignorTodos.js',
                'resources/js/todos.js',
                'resources/js/todoReports.js',
                'resources/js/assignorTodoReports.js',
                'resources/js/assigneeTodoReports.js',
                'resources/js/assigneeTodos.js'
            ],
            refresh: true
        })
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
    build: {
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString()
                    }
                }
            }
        }
    }
});
