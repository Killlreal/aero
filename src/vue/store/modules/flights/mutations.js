export default {
	setItems(state, result) {
		state.items = result._embedded.items
	}
}