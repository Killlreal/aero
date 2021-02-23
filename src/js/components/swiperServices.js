import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

export default function initSwiperServices(){
    const swiperServices = new Swiper('.swiper-container',{
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: 
        {
            delay: 2000,
        },
    });
}
