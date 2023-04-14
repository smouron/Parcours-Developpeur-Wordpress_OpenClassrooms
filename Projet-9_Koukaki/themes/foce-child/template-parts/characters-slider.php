    <!-- Slider main container -->
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