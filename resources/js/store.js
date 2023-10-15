import {createStore} from 'vuex';

const store = createStore({
	state:{
		supervisors: [],
		assignorTodos: [],
		todos: [],
		todoReports: [],
		assignorTodoReports: [],
		assigneeTodoReports: [],
		assigneeTodos: []
	},
	mutations:{
		updateSupervisors(state, payload){
			state.supervisors = payload
		},
		updateAssignorTodos(state, payload){
			state.assignorTodos = payload
		},
		updateTodos(state, payload){
			state.todos = payload
		},
		updateTodoReports(state, payload){
			state.todoReports = payload
		},
		updateAssignorTodoReports(state, payload){
			state.assignorTodoReports = payload
		},
		updateAssigneeTodoReports(state, payload){
			state.assigneeTodoReports = payload
		},
		updateAssigneeTodos(state, payload){
			state.assigneeTodos = payload
		}
	},
	actions:{
		setSupervisors(context, payload){
			context.commit('updateSupervisors', payload)
		},
		removeSupervisors(context){
			context.commit('updateSupervisors', [])
		},
		setAssignorTodos(context, payload){
			context.commit('updateAssignorTodos', payload)
		},
		removeAssignorTodos(context){
			context.commit('updateAssignorTodos', [])
		},
		setTodos(context, payload){
			context.commit('updateTodos', payload)
		},
		removeTodos(context){
			context.commit('updateTodos', [])
		},
		setTodoReports(context, payload){
			context.commit('updateTodoReports', payload)
		},
		removeTodoReports(context){
			context.commit('updateTodoReports', [])
		},
		setAssignorTodoReports(context, payload){
			context.commit('updateAssignorTodoReports', payload)
		},
		removeAssignorTodoReports(context){
			context.commit('updateAssignorTodoReports', [])
		},
		setAssigneeTodoReports(context, payload){
			context.commit('updateAssigneeTodoReports', payload)
		},
		removeAssigneeTodoReports(context){
			context.commit('updateAssigneeTodoReports', [])
		},
		setAssigneeTodos(context, payload){
			context.commit('updateAssigneeTodos', payload)
		},
		removeAssigneeTodos(context){
			context.commit('updateAssigneeTodos', [])
		}
	},
	getters:{
		getSupervisors: function(state){
			return state.supervisors
		},
		getAssignorTodos: function(state){
			return state.assignorTodos
		},
		getTodos: function(state){
			return state.todos
		},
		getTodoReports: function(state){
			return state.todoReports
		},
		getAssignorTodoReports: function(state){
			return state.assignorTodoReports
		},
		getAssigneeTodoReports: function(state){
			return state.assigneeTodoReports
		},
		getAssigneeTodos: function(state){
			return state.assigneeTodos
		}
	}
})

export default store