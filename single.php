<?php get_header(); ?>

    <main class="single content">

        <?php if ( have_posts() ) : the_post(); ?>
            <div class="author">
                <h4>Author</h4>
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 200 ); ?><br>
                <strong><?php the_author(); ?></strong><br>
                <em class="description"><?php the_author_meta('description'); ?></em>
                <div class="author-page">
                    <a href="<?php the_author_meta('user_url'); ?>">Visit <?php the_author(); ?>'s page</a>
                </div>
            </div>
            <h2><?php the_title(); ?></h2>
            <div class="article-desc">
                <span class="date"><?php echo get_the_date('l, F j, Y'); ?></span>
                <div class="social">
                    <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title());?>%20via%20@GoBeautySA&url=<?php echo get_permalink();?>"><span class="socicon">a</span></a>
                    <a href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo urlencode(get_the_title());?>&p[url]=<?php echo get_permalink();?>&p[summary]=mysexysummaryhere&p[images][0]=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">b</span></a>
                    <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink();?>&description=<?php echo urlencode(get_the_title());?>&media=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">d</span></a>
                </div>
            </div>
            <?php the_content(); ?>
        <?php endif; ?>

        <div class="clear-fix"></div>

        <div class="navigation">
            <div class="alignleft">
                <?php previous_post('%', '<span>&laquo;&laquo; Previous post</span><br> ', 'yes'); ?>
            </div>
            <div class="alignright">
                <?php next_post('%', '<span>Next post &raquo;&raquo;</span><br> ', 'yes'); ?>
            </div>
            <div class="clear-fix"></div>
        </div> <!-- end navigation -->

    </main>

<?php get_footer(); ?>