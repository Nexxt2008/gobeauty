<?php $args = array('posts_per_page' => 5 ); query_posts($args); ?>
    <?php if (have_posts()) : ?>
        <div class="mycarousel">
            <ul>
                <?php while (have_posts()) : the_post(); ?>
                    <li class="post">
                        <div class="img-wrapper">
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail("post-entry");
                                } else {
                                    echo "<img src='".get_bloginfo('template_directory')."/images/article-bg.png' class='attachment-post-entry wp-post-image' >";
                                }
                            ?>
                        </div>
                        <div class="post-social">
                            <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title());?>%20via%20@GoBeautySA&url=<?php echo get_permalink();?>"><span class="socicon">a</span></a>
                            <a href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo urlencode(get_the_title());?>&p[url]=<?php echo get_permalink();?>&p[summary]=mysexysummaryhere&p[images][0]=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">b</span></a>
                            <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink();?>&description=<?php echo urlencode(get_the_title());?>&media=<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>"><span class="socicon">d</span></a>
                        </div>
                        <div class="description">
                            <div class="author-date">                                        
                                by <span class="author-name"><?php the_author(); ?></span> <?php echo get_the_date('F j, Y'); ?> 
                            </div>
                            <div class="post-title<?php if (strlen(get_the_title()) > 60) echo ' long-title'; ?>">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php wp_reset_query(); ?>
<div class="clear-fix"></div>