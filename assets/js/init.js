import AOS from "aos";

var swiper = new Swiper(".mySwiper", {
    loop:true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

AOS.init();