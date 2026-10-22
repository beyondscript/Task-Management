import { useStore } from 'vuex';
export default function assigneeTodos(){
	const store = useStore()
	const allTodos = async() => {
		try{
			let response = await axios.get('/api/assignee-todos')
			await store.dispatch('setAssigneeTodos', response.data.todos)
		}
		catch(error){ throw error }
	}
	return{
		allTodos
	}
}
