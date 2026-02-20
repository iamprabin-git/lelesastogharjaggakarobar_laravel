import './bootstrap';
import 'flowbite';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs';
import { Navigation, Pagination } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.swiper').forEach((el) => {
        new Swiper(el, {
            modules: [Navigation, Pagination],
            loop: true,
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
        });
    });
});

window.Alpine = Alpine;
Alpine.start();

