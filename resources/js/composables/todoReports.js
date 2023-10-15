import { useStore } from 'vuex';
export default function todoReports(){
	const store = useStore()
	const getTodoReports = async() => {
		try{
			let response = await axios.get('/api/get-todo-reports')
			store.dispatch('setTodoReports', response.data.todoReports)
		}
		catch(error){}
	}
	return{
		getTodoReports
	}
}