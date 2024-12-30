import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, FreeMode } from 'swiper/modules';

export const swiperSecondary = new Swiper('.swiper-container-secondary', {
    modules: [Navigation, Pagination, FreeMode, Autoplay],
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 30,
    centeredSlides: false,
    watchSlidesProgress: true,
    loop: false,
    speed: 1500,
    navigation: {
        nextEl: '.secondary-swiper-button-next',
        prevEl: '.secondary-swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return `<span class="${className}" style="background-color: orange; border-radius: 50%; width: 12px; height: 12px; display: inline-block; margin: 0 4px;"></span>`;
        }
    },
    fill :{
        type: 'row',
        rows: 2
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
    }
});
