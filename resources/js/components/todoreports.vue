<template>
	<canvas id="todosLineChart"></canvas>
</template>
<script>
	import { onMounted, onBeforeUnmount } from 'vue';
	import todoReports from "../../js/composables/todoReports";
	import Chart from 'chart.js/auto';
	import { useStore } from 'vuex';
	export default{
		setup(){
			const { getTodoReports } = todoReports()
			const store = useStore()
			onMounted(
				async() => {
					await getTodoReports()
					const ctx = document.getElementById('todosLineChart')
					const chart = new Chart(ctx, {
					    type: 'line',
					    data: {
					      	labels: store.getters.getTodoReports[0].lebels,
					      	datasets: [
						      	{
							        label: 'Assigned Tasks',
							        data: store.getters.getTodoReports[0].datas,
							        backgroundColor: 'red',
							        borderColor: 'red',
							        borderWidth: 1,
							        tension: 0.15
						      	},
						      	{
							        label: 'Completed Tasks',
							        data: store.getters.getTodoReports[0].completedDatas,
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
					store.dispatch('removeTodoReports')
				}
			)
		}
	}
</script>