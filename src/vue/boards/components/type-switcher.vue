<template lang = "pug">
.flights-hat__filters
	input.flights-filter(
		type = "button"
		value = "Вылет"
		:class = "{'flights-filter_active': filter.type == 'departure'}"
		@click = "changetype('departure')"
		)
	input.flights-filter(
		type = "button"
		value = "Прибытие"
		:class = "{'flights-filter_active': filter.type == 'arrival'}" 
		@click = "changetype('arrival')"
		)
</template>

<script>
import { mapActions } from 'vuex'
import moment from 'moment'

export default {
	data(){
		return {
			filter: {
				target: undefined,
				date: undefined,
				type: undefined
			}
		}
	},
	methods: {
		...mapActions('flights', ["fetchItems"]),
		async changetype(type){
			this.filter.type = type
			await this.fetchItems(this.filter)
		},
		async changedate(date){
			this.filter.date = date
			await this.fetchItems(this.filter)
		}
	},
	props: {
		params: Array
	},
	created(){
		this.filter.target = this.$props.params[0]
		this.filter.type = this.$props.params[1]
		this.filter.date = moment().format('YYYY-MM-DD')
	}
}
</script>