<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <?php
            while ( $characters_query->have_posts() ) {
                $characters_query->the_post();
                    echo '<div class="swiper-slide">';
                    echo '<figure>';
                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                    echo '<figcaption>';
                    the_title();
                    echo'</figcaption>';
                    echo '</figure>';
                    echo '</div>';
            }
        ?>                        
    </div>
</div>

   <!-- Swiper JS -->
   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
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

</script>


