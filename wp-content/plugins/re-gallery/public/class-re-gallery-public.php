<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://localhost
 * @since      1.0.0
 *
 * @package    Re_Gallery
 * @subpackage Re_Gallery/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Re_Gallery
 * @subpackage Re_Gallery/public
 * @author     Alex <email@email.com>
 */
class Re_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

        add_action('re_get_gallery_images', [__CLASS__, 're_get_gallery_images_array'], 10, 1);

	}

    public static function re_get_gallery_images_array($post_id)
    {
        $images = [];
        $gallery = get_post_meta(get_the_ID(), 'gallery_data', true);

        $images[] = get_the_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id) : get_stylesheet_directory_uri() . '/img/placeholder.svg';

        if ($gallery && array_key_exists('image_url', $gallery)) {
            foreach ($gallery['image_url'] as $url) {
                $images[] = $url;
            }
        }

        if (count($images) > 1): ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($images as $key => $image): ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="<?php echo $key; ?>" <?php echo ($key === 0) ? 'class="active" aria-current="true"' : ''; ?>
                                aria-label="Slide <?php echo $key; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($images as $key => $image): ?>
                        <div class="carousel-item <?php echo ($key === 0) ? 'active' : ''; ?>">
                            <img src="<?php echo $image; ?>" class="d-block w-100"
                                 alt="<?php echo get_the_title() ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <img src="<?php echo $images[0]; ?>" alt="<?php echo get_the_title() ?>">
        <?php endif;

    }
}
