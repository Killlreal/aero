import Vue from 'vue';
import store from '../../store';
import Layout from './Layout.vue';

export default class {
	constructor(el) {
		new Vue({
			el,
			store,
			render: h => h(Layout),
		});
	}

}
