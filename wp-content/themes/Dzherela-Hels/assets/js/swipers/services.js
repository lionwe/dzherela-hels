import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

const servicesSwiper = () => {
    const slider = document.querySelector('.services__slider');
    if (!slider) return;

    new Swiper(slider, {
        modules: [Navigation, Pagination],
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.services__next',
            prevEl: '.services__prev',
        },
        pagination: {
            el: '.services__pagination',
            clickable: true,
        },
        breakpoints: {
            992: {
                enabled: false,
                slidesPerView: 'auto',
            }
        }
    });
};

document.addEventListener('DOMContentLoaded', servicesSwiper);
