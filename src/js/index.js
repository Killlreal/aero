import "../scss/index.scss";
import Board from "../vue/boards/online"
import Personal from '../vue/personal-cabinet';

import initSwiperServices from "./components/swiperServices";
import initDropdownMenu from "./components/dropdownMenu";
document.addEventListener('DOMContentLoaded', () => {
	new Board('#board', true)
    new Personal('#personal-cabinet');
    initSwiperServices();
    //initDropdownMenu();
});