<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://localhost
 * @since      1.0.0
 *
 * @package    Re_Gallery
 * @subpackage Re_Gallery/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Re_Gallery
 * @subpackage Re_Gallery/admin
 * @author     Alex <email@email.com>
 */
class Re_Gallery_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_init', [__CLASS__, 'add_gallery_metabox']);
        add_action('save_post', [__CLASS__, 'property_gallery_save']);

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Re_Gallery_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Re_Gallery_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $screen = get_current_screen();
        if ($screen->id === 'real_estate') {
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/re-gallery-admin.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Re_Gallery_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Re_Gallery_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $screen = get_current_screen();
        if ($screen->id === 'real_estate') {
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/re-gallery-admin.js', array('jquery'), $this->version, false);
        }

    }

    public static function add_gallery_metabox()
    {
        add_meta_box(
            'post_custom_gallery',
            esc_html__('Галерея изображений', 're-gallery'),
            [__CLASS__, 'property_gallery_metabox_callback'],
            'real_estate', // Change post type name
            'normal',
            'core'
        );

    }

    public static function property_gallery_metabox_callback()
    {
        wp_nonce_field(basename(__FILE__), 'sample_nonce');
        global $post;
        $gallery_data = get_post_meta($post->ID, 'gallery_data', true);
        ?>
        <div id="gallery_wrapper">
            <div id="img_box_container">
                <?php
                if (isset($gallery_data['image_url'])){
                for ($i = 0;
                $i < count($gallery_data['image_url']);
                $i++){
                ?>
                <div class="gallery_single_row dolu">
                    <div class="gallery_area image_container ">
                        <img class="gallery_img_img" src="<?php esc_html_e($gallery_data['image_url'][$i]); ?>"
                             height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                        <input type="hidden"
                               class="meta_image_url"
                               name="gallery[image_url][]"
                               value="<?php esc_html_e($gallery_data['image_url'][$i]); ?>"
                        />
                    </div>
                    <div class="gallery_area">
                        <span class="button remove" onclick="remove_img(this)" title="Remove"/>x</span>
                    </div>
                    <div class="clear"/>
                </div>
            </div>
            <?php
            }
            }
            ?>
        </div>
        <div style="display:none" id="master_box">
            <div class="gallery_single_row">
                <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                    <input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]"/>
                </div>
                <div class="gallery_area">
                    <span class="button remove" onclick="remove_img(this)" title="Remove"/>x</span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="add_gallery_single_row">
            <input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();"
                   title="Add image"/>
        </div>
        </div>
        <?php
    }

    public static function property_gallery_save($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['sample_nonce']) && wp_verify_nonce($_POST['sample_nonce'], basename(__FILE__))) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Correct post type
        if (empty($_POST) || 'real_estate' != $_POST['post_type']) // here you can set the post type name
            return;

        if ($_POST['gallery']) {

            // Build array for saving post meta
            $gallery_data = array();
            for ($i = 0; $i < count($_POST['gallery']['image_url']); $i++) {
                if ('' != $_POST['gallery']['image_url'][$i]) {
                    $gallery_data['image_url'][] = $_POST['gallery']['image_url'][$i];
                }
            }

            if ($gallery_data)
                update_post_meta($post_id, 'gallery_data', $gallery_data);
            else
                delete_post_meta($post_id, 'gallery_data');
        } // Nothing received, all fields are empty, delete option
        else {
            delete_post_meta($post_id, 'gallery_data');
        }
    }

}
