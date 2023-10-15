<template>
	<table id="table" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="supervisor in $store.getters.getSupervisors" :key="supervisor.id">
                <td>{{supervisor.name}}</td>
                <td>{{supervisor.email}}</td>
                <td>
                	<button type="button" class="actions_button_danger" @click="revoke(supervisor.id)" v-if="supervisor.revoked === 0">Revoke</button>
                	<button type="button" class="actions_button_info" @click="approve(supervisor.id)" v-else>Approve</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import supervisors from "../../js/composables/supervisors";
	import $ from 'jquery';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { allSupervisors, revokeSupervisor, approveSupervisor } = supervisors()
			const store = useStore()
			onMounted(
				async() => {
					await allSupervisors()
					$('#table').DataTable({
						scrollX: true
					})
				}
			)
			const revoke = async(id) => {
				await revokeSupervisor(id)
				await allSupervisors()
			}
			const approve = async(id) => {
				await approveSupervisor(id)
				await allSupervisors()
			}
			onBeforeUnmount(
				async() => {
					store.dispatch('removeSupervisors')
				}
			)
			return{
				revoke,
				approve
			}
		}
	}
</script>