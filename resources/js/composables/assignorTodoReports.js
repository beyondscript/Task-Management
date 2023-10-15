import { useStore } from 'vuex';
export default function assignorTodoReports(){
	const store = useStore()
	const getAssignorTodoReports = async() => {
		try{
			let response = await axios.get('/api/get-assignor-todo-reports')
			store.dispatch('setAssignorTodoReports', response.data.assignorTodoReports)
		}
		catch(error){}
	}
	return{
		getAssignorTodoReports
	}
}