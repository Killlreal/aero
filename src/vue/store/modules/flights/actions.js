import ky from 'ky'

export default {
	async fetchItems({commit}, filter){
		let url = new URL(`${window.location.origin}/api/flights/${filter.target}`)
		url.searchParams.set('type', filter.type)
		url.searchParams.set('date', filter.date)
		let result = await ky.get(url).json(url)
		commit("setItems", result)
	}
}