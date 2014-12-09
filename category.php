<?php get_header(); ?>

    <main class="category content">
        <div class="ticker">
            <?php  if(function_exists('ditty_news_ticker')){ditty_news_ticker(604);} ?>
        </div>
        <h1><?php single_cat_title( '', true ); ?></h1>
        <div id="new" class="tab-pane fade in active">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post">
                    <div class="img-wrapper">
                        <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail("post-entry");
                            } else {
                                echo "<img src='".get_bloginfo('template_directory')."/images/article-bg.png' class='attachment-post-entry wp-post-image' >";
                            }
                        ?>
                    </div>
                    <div class="description">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?><br>
                            <?php the_author(); ?> 
                        </div>
                        <div class="post-title">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-social">
                                <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title());?>%20via%20@GoBeautySA&url=<?php echo get_permalink();?>"><span class="socicon">a</span></a>
                                <a href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo urlencode(get_the_title());?>&p[url]=<?php echo get_permalink();?>&p[summary]=mysexysummaryhere&p[images][0]=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">b</span></a>
                                <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink();?>&description=<?php echo urlencode(get_the_title());?>&media=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">d</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
            <div class="clear-fix"></div>
            <div id="pagination" class="more"><?php next_posts_link('View More'); ?></div>
            <?php wp_reset_query(); ?>
        </div>
    </main><!-- .content -->

    <div class="clear-fix"></div>

    <div id="subscribing">
        <?php dynamic_sidebar('Before footer') ?>
    </div>

<?php get_footer(); ?>