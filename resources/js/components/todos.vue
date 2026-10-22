<template>
	<div class="data_table_frame" :aria-busy="loading">
        <LoadingIndicator v-if="loading" label="Loading table…" />
        <div v-else-if="loadError" class="content_loader" role="alert">
            <span>The table could not be loaded.</span>
            <button type="button" class="btn btn-link" @click="reload">Try again</button>
        </div>
        <div :class="{ content_pending: loading || loadError }">
    <table ref="table" id="table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Assignor Supervisor</th>
                <th>Assigned Stuff</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="todo in $store.getters.getTodos" :key="todo.id">
                <td>{{todo.name}}</td>
                <td>{{todo.description}}</td>
                <td>{{todo.assignor.name}}</td>
                <td>{{todo.assignee.name}}</td>
                <td v-if="todo.completed === 0"><span class="task_status task_status_pending">No</span></td>
                <td v-else><span class="task_status task_status_completed">Yes</span></td>
                <td>
                	<button type="button" class="actions_button_danger" @click="destroy(todo.id)">Destroy</button>
                </td>
            </tr>
        </tbody>
    </table>
        </div>
    </div>
</template>
<script>
import { onBeforeUnmount } from 'vue'
import todos from '../composables/todos'
import useDataTable from '../composables/dataTable'
import { useStore } from 'vuex'
import LoadingIndicator from './LoadingIndicator.vue'

export default {
    components: { LoadingIndicator },
    setup() {
        const { allTodos, destroyTodo } = todos()
        const store = useStore()
        const { table, loading, loadError, reload } = useDataTable(allTodos)

        const destroy = async (id) => {
            await destroyTodo(id)
            await reload()
        }
        onBeforeUnmount(() => store.dispatch('removeTodos'))

        return { table, loading, loadError, reload, destroy }
    }
}
</script>
