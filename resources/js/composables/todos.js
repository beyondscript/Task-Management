import { useStore } from 'vuex';
export default function todos(){
	const store = useStore()
	const allTodos = async() => {
		try{
			let response = await axios.get('/api/all-todos')
			store.dispatch('setTodos', response.data.todos)
		}
		catch(error){}
	}
	const destroyTodo = async(id) => {
		const formData = new FormData()
        formData.append('id', id)
		formData.append('_method', 'delete')
		try{
			let response = await axios.post('/api/destroy-todo', formData)
			toastr.info('Todo successfully destroyed')
		}
		catch(error){}
	}
	return{
		allTodos,
		destroyTodo
	}
}