<template>
	<table id="table" class="table table-striped table-bordered" width="100%">
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
                <td v-if="todo.completed === 0">No</td>
                <td v-else>Yes</td>
                <td>
                	<button type="button" class="actions_button_danger" @click="destroy(todo.id)">Destroy</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import todos from "../../js/composables/todos";
	import $ from 'jquery';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { allTodos, destroyTodo } = todos()
			const store = useStore()
			onMounted(
				async() => {
					await allTodos()
					$('#table').DataTable({
						scrollX: true
					})
				}
			)
			const destroy = async(id) => {
				await destroyTodo(id)
				$('#table').DataTable().destroy()
				await allTodos()
				$('#table').DataTable({
					scrollX: true
				})
			}
			onBeforeUnmount(
				async() => {
					store.dispatch('removeTodos')
				}
			)
			return{
				destroy
			}
		}
	}
</script>