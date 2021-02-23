import Vue from 'vue';
import personal from './personal-cabinet.vue';

export default class Personal{
    constructor(selector){
        new Vue({
            el: selector,
            render: h => h(personal),
        })
    }
}