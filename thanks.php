<?php
/*
Template name: Thanks
 */
get_header(); ?>
    <main class="single content">
        <?php if ( have_posts() ) : the_post(); ?>
            <br><br><?php the_content(); ?>
        <?php endif; ?>
        <div class="clear-fix"></div>
    </main>
<?php get_footer(); ?>