import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

const doctorsSwiper = () => {
    const slider = document.querySelector('.our-doctors__slider');
    if (!slider) return;

    new Swiper(slider, {
        modules: [Navigation, Pagination],
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.our-doctors__next',
            prevEl: '.our-doctors__prev',
        },
        pagination: {
            el: '.our-doctors__pagination',
            clickable: true,
        },
        breakpoints: {
            992: {
                slidesPerView: 1.9,
                spaceBetween: 20,
            }
        }
    });
};

document.addEventListener('DOMContentLoaded', doctorsSwiper);
