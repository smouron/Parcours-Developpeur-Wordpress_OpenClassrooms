 // Initialize Swiper
        var swiper = new Swiper('.swiper-container', {
            // spaceBetween: 150,
            speed: 1000,
            autoplay: {
                delay: 250,
            },
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: 2,
            coverflowEffect: {
                rotate: 80,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            autoplay: {
                delay: 2500,
                // disableOnInteraction: false,
            },

        })