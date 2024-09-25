import { useStore } from 'vuex';
export default function assigneeTodos(){
	const store = useStore()
	const allTodos = async() => {
		try{
			let response = await axios.get('/api/assignee-todos')
			store.dispatch('setAssigneeTodos', response.data.todos)
		}
		catch(error){}
	}
	return{
		allTodos
	}
}