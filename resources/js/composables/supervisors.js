import { useStore } from 'vuex';
export default function supervisors(){
	const store = useStore()
	const allSupervisors = async() => {
		try{
			let response = await axios.get('/api/all-supervisors')
			store.dispatch('setSupervisors', response.data.supervisors)
		}
		catch(error){}
	}
	const revokeSupervisor = async(id) => {
		const formData = new FormData()
        formData.append('id', id)
		formData.append('_method', 'patch')
		try{
			let response = await axios.post('/api/revoke-supervisor', formData)
			toastr.info('Supervisor successfully revoked')
		}
		catch(error){}
	}
	const approveSupervisor = async(id) => {
		const formData = new FormData()
        formData.append('id', id)
		formData.append('_method', 'patch')
		try{
			let response = await axios.post('/api/approve-supervisor', formData)
			toastr.info('Supervisor successfully approved')
		}
		catch(error){}
	}
	return{
		allSupervisors,
		revokeSupervisor,
		approveSupervisor
	}
}