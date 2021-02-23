<template lang = "pug">
section.flights-board.margin-auto
	.flights-board__headline Табло рейсов
	.flights-board__table
		.flights-hat
			TypeSwitcher(ref = "switcher" :params = "params")
			.flights-hat__datetime
				.flights-date.mr-40
					p.flights-date__title Дата
					.flights-date__content
						mainCalendar(ref="cal" @filter = "filterByDate")
						svg.flights-date__icon
							use(href='/assets/icons/icons.svg#flights-date-icon')
				.flights-time
					p.flights-time__title Наше время:
					p.flights-time__number {{ currentTime }}
		FlightItem(
			v-for = "item in filtereditems" 
			:flight = "item"
			)
	.flights-board__all(v-if="$parent.$options.widget")
		a(href='/tablo-reysov') Все рейсы

</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import TypeSwitcher from '../components/type-switcher.vue'
import FlightItem from './components/item.vue'
import moment from 'moment'
import mainCalendar from '../components/Calendar/mainCalendar.vue'

export default {
	data(){
		return {
			params: ['online', 'departure'],
//			value: [null, null]
		}
	},
	components: {
		TypeSwitcher,
		FlightItem,
		mainCalendar
	},
	computed: {
		...mapGetters('flights', ["items"]),
		filtereditems(){
			return (this.$parent.$options.widget) ? this.items.slice(0,5) : this.items
		},
		currentDate(){
			return moment().format('D.MM.YYYY')
		},
		currentTime(){
			return moment().format('H:mm')
		}
	},
	methods: {
		...mapActions('flights', ["fetchItems", "setFilterDate"]),
		async filterByDate(date){
			await this.$refs.switcher.changedate(date)
		}
	},
	async created(){
		await this.fetchItems({target: this.params[0], type: this.params[1], date: moment().format('YYYY-MM-DD')})
	//	initCalendar()
	}
}
</script>

