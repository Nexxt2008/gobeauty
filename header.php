<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title><?php wp_title('', true); ?></title>

    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/style.css" type="text/css" />
    <script src="<?php bloginfo('template_directory');?>/js/jquery.min.js"></script>
    <script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
    
    <?php if (is_front_page() || is_page_template('thanks.php') || is_category()) { ?>
        <?php
            wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
            wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
        ?>
        <script src="<?php bloginfo('template_directory');?>/js/jcarousellite-1.0.1.min.js"></script>
        <script type="text/javascript">
            jQuery(function($) {
                $(".mycarousel").jCarouselLite({
                    auto: true,
                    speed: 2000,
                    circular: true,
                    visible: 4
                });

                $('.attachment-post-entry').each(function(){
                    if ($(this).width() > $(this).parents(".post").width())
                        $(this).css("margin-left", -($(this).width() - $(".post").width())/2);
                });
            });
        </script>
    <?php } ?>

    <?php 
    if (is_single()) {
        if (MultiPostThumbnails::has_post_thumbnail('post', 'secondary-image', NULL)) { ?>
            <script src="<?php bloginfo('template_directory');?>/js/jquery.backstretch.min.js"></script>
            <script>
                jQuery(document).ready( function($) {
                    $("#top-image").backstretch("<?php echo MultiPostThumbnails::get_post_thumbnail_url('post', 'secondary-image'); ?>");
                });
            </script>
        <?php } else { ?>
            <script>
                jQuery(document).ready( function($) {
                    $(".single .author").addClass("without-top-image");

                });
            </script>
        <?php } ?>
    <?php } ?>

    <?php
    if (!empty($_POST['subscriber_email'])) {	
        $headers = 'From: Gobeauty blog <contact@gobeauty.co.za>' . "\r\n";
        wp_mail('contact@gobeauty.co.za', 'Gobeauty new subscriber', $_POST['subscriber_email'], $headers);
    }
    ?>

    <?php wp_head(); ?>
    
</head>
<body <?php body_class( $class ); ?>>

    <header class="header">
        <a href="/" class="logo">
            <img src="<?php bloginfo('template_directory');?>/images/logo.png" />
        </a>
        <div class="top-social">
            <a href="<?php echo get_option('header_t'); ?>"><span class="socicon">a</span></a>
            <a href="<?php echo get_option('header_f'); ?>"><span class="socicon">b</span></a>
            <a href="<?php echo get_option('header_p'); ?>"><span class="socicon">d</span></a>
        </div>
    </header><!-- .header-->

    <?php if (is_single() && MultiPostThumbnails::has_post_thumbnail('post', 'secondary-image', NULL)) { ?>
        <div id="top-image"></div>
    <?php } ?>

    <?php if (is_front_page() || is_page_template('thanks.php')) { ?>
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
    <?php } ?>
    <?php if (is_front_page() || is_category()) { ?>
        <div class="grey-block"></div>
    <?php } ?>
<div class="wrapper">