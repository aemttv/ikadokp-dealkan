import Swiper from 'swiper';
import {Navigation, Pagination, Autoplay, FreeMode } from 'swiper/modules';

// Init Swiper:
export const swiperStrategic = new Swiper('.swiper-container-strategic', {
    modules: [Navigation, Pagination, FreeMode, Autoplay], // Tambahkan Autoplay di sini
    slidesPerView: 3, // Tampilkan 3 card sekaligus
    slidesPerGroup: 3, // Geser 3 card sekaligus
    spaceBetween: 30, // Jarak antar card
    centeredSlides: false, // Pastikan tidak ada centering
    watchSlidesProgress: true, // Pantau progress untuk mencegah card terpotong
    loop: true, // Aktifkan looping agar bisa berulang
    speed: 1500, // Kecepatan transisi antar card (dalam ms)

    // Optional parameters
    direction: 'horizontal',
    freeMode: false, // Setel freeMode ke false untuk loop

    // Autoplay settings
    autoplay: {
      delay: 3000, // Waktu jeda antar slide (dalam ms)
      disableOnInteraction: false, // Jangan hentikan autoplay saat pengguna berinteraksi
    },

    // Pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return `<span class="${className}" style="background-color: orange; border-radius: 50%; width: 12px; height: 12px; display: inline-block; margin: 0 4px;"></span>`;
    }

    },

    breakpoints: {
      320: { // Ukuran layar HP kecil
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 10, // Jarak antar card yang lebih kecil di layar kecil
      },
      640: { // Layar HP menengah
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 20,
      },
      768: { // Tablet
        slidesPerView: 2,
        slidesPerGroup: 2,
        spaceBetween: 30,
      },
      1024: { // Layar besar
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 30,
      },
    }

});
