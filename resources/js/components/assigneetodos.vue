<template>
	<table id="table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Assignor Supervisor</th>
                <th>Completed</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="todo in $store.getters.getAssigneeTodos" :key="todo.id">
                <td>{{todo.name}}</td>
                <td>{{todo.description}}</td>
                <td>{{todo.assignor.name}}</td>
                <td v-if="todo.completed === 0">No</td>
                <td v-else>Yes</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import assigneeTodos from "../../js/composables/assigneeTodos";
	import $ from 'jquery';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { allTodos } = assigneeTodos()
			const store = useStore()
			onMounted(
				async() => {
					await allTodos()
					$('#table').DataTable({
						scrollX: true
					})
				}
			)
			onBeforeUnmount(
				async() => {
					store.dispatch('removeAssigneeTodos')
				}
			)
		}
	}
</script>