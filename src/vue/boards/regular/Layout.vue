<template lang = "pug">
.flights-board__table-regular
	.flights-hat
		TypeSwitcher(:params = "params")
	FlightItem(v-for = "item in items" :flight = "item")


</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import FlightItem from './components/item.vue'
import TypeSwitcher from '../components/type-switcher.vue'

export default {
	data(){
		return {
			params: ['regular', 'departure']
		}
	},
	components: {
		TypeSwitcher,
		FlightItem
	},
	computed: {
		...mapGetters('flights', ["items"])
	},
	methods: {
		...mapActions('flights', ["fetchItems"]),
	},
	async created(){
		this.fetchItems({target: this.params[0], type: this.params[1]})
	}
}
</script>

