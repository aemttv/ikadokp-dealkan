import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, FreeMode, Grid } from 'swiper/modules';

export const swiperSecondary = new Swiper('.swiper-container-tolak', {
    modules: [Navigation, Pagination, FreeMode, Autoplay, Grid],
    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 30,
    centeredSlides: false,
    watchSlidesProgress: true,
    loop: false,
    speed: 1500,
    navigation: {
        nextEl: '.tolak-swiper-button-next',
        prevEl: '.tolak-swiper-button-prev',
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
