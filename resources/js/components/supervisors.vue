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
        </div>
    </div>
</template>
<script>
import { onBeforeUnmount } from 'vue'
import supervisors from '../composables/supervisors'
import useDataTable from '../composables/dataTable'
import { useStore } from 'vuex'
import LoadingIndicator from './LoadingIndicator.vue'

export default {
    components: { LoadingIndicator },
    setup() {
        const { allSupervisors, revokeSupervisor, approveSupervisor } = supervisors()
        const store = useStore()
        const { table, loading, loadError, reload } = useDataTable(allSupervisors)

        const revoke = async (id) => {
            await revokeSupervisor(id)
            await reload()
        }
        const approve = async (id) => {
            await approveSupervisor(id)
            await reload()
        }
        onBeforeUnmount(() => store.dispatch('removeSupervisors'))

        return { table, loading, loadError, reload, revoke, approve }
    }
}
</script>
