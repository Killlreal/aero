import Vue from 'vue';
import store from '../../store';
import Layout from './Layout.vue';

export default class {
	constructor(el, widget = false) {
		new Vue({
			el,
			store,
			widget,
			render: h => h(Layout),
		});
	}

}
