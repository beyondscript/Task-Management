import { useStore } from 'vuex';
export default function assignorTodos(){
	const store = useStore()
	const allTodos = async() => {
		try{
			let response = await axios.get('/api/assignor-todos')
			store.dispatch('setAssignorTodos', response.data.todos)
		}
		catch(error){}
	}
	const markTodoAsCompleted = async(id) => {
		const formData = new FormData()
        formData.append('id', id)
		formData.append('_method', 'patch')
		try{
			let response = await axios.post('/api/mark-todo-as-completed', formData)
			toastr.info('Todo successfully marked as completed')
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
		markTodoAsCompleted,
		destroyTodo
	}
}