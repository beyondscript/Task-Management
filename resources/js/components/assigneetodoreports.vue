<template>
	<canvas id="todosLineChart"></canvas>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import assigneeTodoReports from "../../js/composables/assigneeTodoReports";
	import Chart from 'chart.js/auto';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { getAssigneeTodoReports } = assigneeTodoReports()
			const store = useStore()
			onMounted(
				async() => {
					await getAssigneeTodoReports()
					const ctx = document.getElementById('todosLineChart')
					const chart = new Chart(ctx, {
					    type: 'line',
					    data: {
					      	labels: store.getters.getAssigneeTodoReports[0].lebels,
					      	datasets: [
						      	{
							        label: 'Assigned Tasks',
							        data: store.getters.getAssigneeTodoReports[0].datas,
							        backgroundColor: 'red',
							        borderColor: 'red',
							        borderWidth: 1,
							        tension: 0.15
						      	},
						      	{
							        label: 'Completed Tasks',
							        data: store.getters.getAssigneeTodoReports[0].completedDatas,
							        backgroundColor: 'blue',
							        borderColor: 'blue',
							        borderWidth: 1,
							        tension: 0.30
						      	}
					      	]
					    },
					    options: {
					      	scales: {
						        y: {
						          	beginAtZero: true,
						          	ticks: {
								        precision: 0
								    }
						        }
					      	}
					    }
					})
				}
			)
			onBeforeUnmount(
				async() => {
					store.dispatch('removeAssigneeTodoReports')
				}
			)
		}
	}
</script>