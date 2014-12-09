</div><!-- .wrapper -->
<div class="clear-fix"></div>
	
<footer class="footer">
    <div class="copyright">
        &copy; Copyright - <a href="<?php bloginfo('url'); ?>">Gobeauty</a>
    </div>
</footer><!-- .footer -->

<!-- JS -->
<script src="<?php bloginfo('template_directory');?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>

<?php if (is_front_page() || is_category()) {
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

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-44979856-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>
<?php wp_footer(); ?>

</body>
</html>