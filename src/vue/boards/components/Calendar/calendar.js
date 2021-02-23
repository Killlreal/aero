import Vue from 'vue'
import App from './mainCalendar.vue'

export default function () {

  Vue.config.productionTip = false

  new Vue({
    render: h => h(App),
  }).$mount('#calendar')

}