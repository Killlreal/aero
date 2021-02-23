<template lang = "pug">
.flight-item-container.flight-item-container__part
	p.flight-item-key {{ item[0] }}
	p.flight-item-value {{ item[1] }}
</template>

<script>
export default {
	data(){
		return {}
	},
	props: {
		item: Array
	},

}
</script>
