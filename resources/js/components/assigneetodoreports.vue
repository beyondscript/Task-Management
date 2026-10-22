<template>
    <div class="report_chart" :aria-busy="loading">
        <LoadingIndicator v-if="loading" label="Loading reports…" />
        <div v-else-if="loadError" class="content_loader" role="alert">
            <span>Reports could not be loaded.</span>
            <button type="button" class="btn btn-link" @click="loadReport">Try again</button>
        </div>
        <canvas ref="canvas" id="todosLineChart" :class="{ content_pending: loading || loadError }"
            role="img" aria-label="Assigned and completed task reports"></canvas>
    </div>
</template>

<script>
import { nextTick, onMounted, onBeforeUnmount, ref } from 'vue'
import assigneeTodoReports from '../composables/assigneeTodoReports'
import Chart from 'chart.js/auto'
import { useStore } from 'vuex'
import LoadingIndicator from './LoadingIndicator.vue'

export default {
    components: { LoadingIndicator },
    setup() {
        const { getAssigneeTodoReports } = assigneeTodoReports()
        const store = useStore()
        const canvas = ref(null)
        const loading = ref(true)
        const loadError = ref(false)
        let chart = null
        let disposed = false

        const loadReport = async () => {
            loading.value = true
            loadError.value = false
            try {
                await getAssigneeTodoReports()
                await nextTick()
                if (disposed) return
                const report = store.getters.getAssigneeTodoReports[0]
                if (!report) throw new Error('Report data is unavailable')
                chart?.destroy()
                chart = new Chart(canvas.value, {
                    type: 'line',
                    data: {
                        labels: report.lebels,
                        datasets: [
                            {
                                label: 'Assigned Tasks',
                                data: report.datas,
                                backgroundColor: '#7354e8',
                                borderColor: '#7354e8',
                                borderWidth: 2,
                                tension: 0.15
                            },
                            {
                                label: 'Completed Tasks',
                                data: report.completedDatas,
                                backgroundColor: '#219b83',
                                borderColor: '#219b83',
                                borderWidth: 2,
                                tension: 0.30
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                })
            } catch (error) {
                if (!disposed) loadError.value = true
            } finally {
                if (!disposed) loading.value = false
            }
        }

        onMounted(loadReport)
        onBeforeUnmount(() => {
            disposed = true
            chart?.destroy()
            store.dispatch('removeAssigneeTodoReports')
        })

        return { canvas, loading, loadError, loadReport }
    }
}
</script>
