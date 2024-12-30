import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, FreeMode } from 'swiper/modules';

export const swiperPrimary = new Swiper('.swiper-container-primary', {
    modules: [Navigation, Pagination, FreeMode, Autoplay],
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 30,
    centeredSlides: false,
    watchSlidesProgress: true,
    loop: false,
    speed: 1500,
    navigation: {
        nextEl: '.primary-swiper-button-next',
        prevEl: '.primary-swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return `<span class="${className}" style="background-color: orange; border-radius: 50%; width: 12px; height: 12px; display: inline-block; margin: 0 4px;"></span>`;
        }
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 30,
        },
    },
});

