import { nextTick, onBeforeUnmount, onMounted, ref } from 'vue'
import $ from 'jquery'

export default function useDataTable(fetchRows) {
    const table = ref(null)
    const loading = ref(true)
    const loadError = ref(false)
    let dataTable = null
    let disposed = false

    const reload = async () => {
        loading.value = true
        loadError.value = false
        try {
            dataTable?.destroy()
            dataTable = null
            await fetchRows()
            await nextTick()
            if (disposed) return
            // Flush visibility before measuring; initialization finishes before the next paint.
            loading.value = false
            await nextTick()
            if (disposed) return
            dataTable = $(table.value).DataTable({ scrollX: true })
        } catch (error) {
            if (!disposed) loadError.value = true
        } finally {
            if (!disposed) {
                loading.value = false
                await nextTick()
                if (!disposed) dataTable?.columns.adjust()
            }
        }
    }

    onMounted(reload)
    onBeforeUnmount(() => {
        disposed = true
        dataTable?.destroy()
    })

    return { table, loading, loadError, reload }
}
