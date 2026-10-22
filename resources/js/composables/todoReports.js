import { useStore } from 'vuex';
export default function todoReports(){
	const store = useStore()
	const getTodoReports = async() => {
		try{
			let response = await axios.get('/api/get-todo-reports')
			await store.dispatch('setTodoReports', response.data.todoReports)
		}
		catch(error){ throw error }
	}
	return{
		getTodoReports
	}
}
