import { useStore } from 'vuex';
export default function assigneeTodoReports(){
	const store = useStore()
	const getAssigneeTodoReports = async() => {
		try{
			let response = await axios.get('/api/get-assignee-todo-reports')
			store.dispatch('setAssigneeTodoReports', response.data.assigneeTodoReports)
		}
		catch(error){}
	}
	return{
		getAssigneeTodoReports
	}
}