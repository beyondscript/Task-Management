<template>
	<table id="table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Assigned Stuff</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="todo in $store.getters.getAssignorTodos" :key="todo.id">
                <td>{{todo.name}}</td>
                <td>{{todo.description}}</td>
                <td>{{todo.assignee.name}}</td>
                <td v-if="todo.completed === 0">No</td>
                <td v-else>Yes</td>
                <td>
                	<div class="multiple_buttons">
                		<button type="button" class="actions_button_info with_another_button" @click="markAsCompleted(todo.id)" v-if="todo.completed === 0">Mark as Completed</button>
                		<button type="button" class="actions_button_danger" @click="destroy(todo.id)">Destroy</button>
                	</div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import assignorTodos from "../../js/composables/assignorTodos";
	import $ from 'jquery';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { allTodos, markTodoAsCompleted, destroyTodo } = assignorTodos()
			const store = useStore()
			onMounted(
				async() => {
					await allTodos()
					$('#table').DataTable({
						scrollX: true
					})
				}
			)
			const markAsCompleted = async(id) => {
				await markTodoAsCompleted(id)
				await allTodos()
			}
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
					store.dispatch('removeAssignorTodos')
				}
			)
			return{
				markAsCompleted,
				destroy
			}
		}
	}
</script>