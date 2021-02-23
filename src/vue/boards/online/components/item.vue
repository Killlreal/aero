<template lang = "pug">
.flight-item
	.flight-item-container.flight-item-container__part.flight-item-container__part
		p.flight-item-key Рейс: 
		p.flight-item-value {{ flight.flight }} / {{ flight.craft }}
	.flight-item-container.flight-item-container__part
		p.flight-item-key Вылет: 
		p.flight-item-value {{ flight.st1.substr(0,5) }}
	.flight-item-container.flight-item-container__part.flight-item-route
		p.flight-item-value {{ flight.airport_departure }}
		svg.flight-item-route__line
			use(href='/assets/icons/icons.svg#flight-route-line')
		svg.flight-item-route__minline
			use(href='/assets/icons/icons.svg#flight-route-line-mins')
		svg.flight-item-route__plane
			use(href='/assets/icons/icons.svg#flight-route-plane')
		svg.flight-item-route__line
			use(href='/assets/icons/icons.svg#flight-route-line')
		svg.flight-item-route__minline
			use(href='/assets/icons/icons.svg#flight-route-line-mins')
		p.flight-item-value {{ flight.airport_arrival }}
	.flight-item-container.flight-item-container__part
		p.flight-item-key Прилет:
		p.flight-item-value {{ flight.st2.substr(0,5) }}
	.flight-item-container.flight-item-container__part.flight-item__status
		p.flight-item-key Статус:
		p.flight-item-value.flight-item-status_not-departed {{ flight.remark }}
	.flight-item-container.flight-item-container__part
		svg.flight-item-detail-icon
			use(href='/assets/icons/icons.svg#flight-info-icon')
</template>

<script>

export default {
	data(){
		return {
		}
	},
	props: {
		flight: Object,
	},
	computed: {

	},
	methods: {

	},
}
</script>

