<template lang = "pug">
.flights-item-regular
	.flights-item-regular-row
		Row(v-for = "(value,key) in description" :item = "[key, value]")
	.flights-item-regular-row
		.flight-item-container.flight-item-container__part.flight-item-route
			p.flight-item-value {{ flight.airport_departure }}
			svg(class='flight-item-route__line')
				use(href='/assets/icons/icons.svg#flight-route-line')
			svg(class='flight-item-route__minline')
				use(href='/assets/icons/icons.svg#flight-route-line-mins')
			svg(class='flight-item-route__plane')
				use(href='/assets/icons/icons.svg#flight-route-plane')
			svg(class='flight-item-route__line')
				use(href='/assets/icons/icons.svg#flight-route-line')
			svg(class='flight-item-route__minline')
				use(href='/assets/icons/icons.svg#flight-route-line-mins')
			p.flight-item-value {{ flight.airport_arrival }}
	.flights-item-regular-row
		Row(v-for = "(value,key) in times" :item = "[key, value]")
</template>

<script>
import Row from './item-row.vue'

export default {
	data(){
		return {
		}
	},
	props: {
		flight: Object,
	},
	computed: {
		times(){
			let object = this.$props.flight
			console.log(object)
			return {
				'Вылет': object.time_departure.substr(0,5),
				'Прилет': object.time_arrival.substr(0,5),
			}
		},
		description(){
			let object = this.$props.flight
			console.log(object)
			return {
				'Рейс': object.flight,
				'тип ВС': object.craft,
				'Период': object.period,
				'Вылеты': object.frequency,
			}
		}
	},
	components: {
		Row
	},
	methods: {

	},
}
</script>

