<article class="container-swiper">
    <!-- <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30"
                        slides-per-view="3" centered-slides="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false" loop="true"> -->
    <swiper-container class="mySwiper" space-between="30" slides-per-view="3" centered-slides="true"
                        autoplay-delay="2500" autoplay-disable-on-interaction="false" loop="true">
        <?php
            while ( $characters_query->have_posts() ) {
                $characters_query->the_post();
                    echo '<swiper-slide>';
                    echo '<figure>';
                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                    echo '<figcaption>';
                    the_title();
                    echo'</figcaption>';
                    echo '</figure>';
                    echo '</swiper-slide>';
            }
        ?>                        
    </swiper-container>
</article>