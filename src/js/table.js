import "../scss/index.scss";

import Board from '../vue/boards/online';

document.addEventListener('DOMContentLoaded', () => {
    new Board('#board');
});
