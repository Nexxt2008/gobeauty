<?php
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Top image',
            'id' => 'secondary-image',
            'post_type' => 'post'
        )
    );
}

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' ); 
    add_image_size( 'post-entry', 9999, 360, true ); 
    add_image_size( 'poster', 480, 360, true ); 
    add_image_size( 'top-thumbnail', 9999 );
}

register_sidebar(array('name'=>'Before footer'));

/* Define the custom box */
add_action( 'add_meta_boxes', 'of_add_custom_box_for_post' );
add_action( 'save_post', 'of_save_postdata_for_post' );

function of_add_custom_box_for_post() {
        add_meta_box(
        'of_post',        
        __( 'Social links', 'of_textdomain' ),
        'of_inner_custom_box',
        'post'
        );
}

function of_inner_custom_box( $post ) {
?>
        <table>
            <tr>
                <td><label for="link_t"> Twitter: </label></td>
                <td><input type="text" id="link_t" size="30" name="link_t" value="<?php echo get_post_meta($post->ID, 'link_t', true); ?>" /></td>
            </tr>
            <tr>
                <td><label for="link_f"> Facebook: </label></td>
                <td><input type="text" id="link_f" size="30" name="link_f" value="<?php echo get_post_meta($post->ID, 'link_f', true); ?>" /></td>
            </tr>
            <tr>
                <td><label for="link_p"> Pinterest: </label></td>
                <td><input type="text" id="link_p" size="30" name="link_p" value="<?php echo get_post_meta($post->ID, 'link_p', true); ?>" /></td>
            </tr>
        </table>
<?php 
}

function of_save_postdata_for_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
    update_post_meta( $post_id , 'link_t', $_POST['link_t']);
    update_post_meta( $post_id , 'link_f', $_POST['link_f']);
    update_post_meta( $post_id , 'link_p', $_POST['link_p']);
}


add_action('admin_menu', 'ff_create_menu');

function ff_create_menu() {
    add_menu_page('Gobeauty options', 'Gobeauty options', 'administrator', __FILE__, 'ff_settings_page', $icon_url);
    add_action( 'admin_init', 'ff_register_settings' );
}

function ff_register_settings() {
    register_setting( 'ff-settings-group', 'header_t' );
    register_setting( 'ff-settings-group', 'header_f' );
    register_setting( 'ff-settings-group', 'header_p' );
}

function ff_settings_page() {
?>
<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields('ff-settings-group'); ?>
        <table>
            <tr>
                <h2>Social links to blog:</h2>
            </tr>
            <tr>
                <td>
                    <label for="header_t">Twitter:</label>
                </td>
                <td>
                    <input type-"text" id="header_t" name="header_t" value="<?php echo get_option('header_t'); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="header_f">Facebook:</label>
                </td>
                <td>
                    <input type-"text" id="header_f" name="header_f" value="<?php echo get_option('header_f'); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="header_p">Pinterest:</label>
                </td>
                <td>
                    <input type-"text" id="header_p" name="header_p" value="<?php echo get_option('header_p'); ?>" />
                </td>
            </tr>            
        </table>
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>

<?php } ?>