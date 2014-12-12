<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title><?php wp_title('', true); ?></title>

    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/style.css?<?php echo intval(microtime(1)); ?>" type="text/css" />
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

    <?php if (is_front_page()) {
        include('slides.php');
    } ?>

    <?php if (is_front_page() || is_category()) { ?>
        <div class="grey-block"></div>
    <?php } ?>

<div class="wrapper">