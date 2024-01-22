<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$city = get_post_parent();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header mb-4">

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="row">
            <div class="col-12 col-md-7 mb-4">
                <?php do_action('re_get_gallery_images', get_the_ID()); ?>
            </div>
            <div class="col-12 col-md-5 mb-4">
                <?php if ($city):
                    echo '<div class="info-text">' . __('Город: ', 'understrap') . $city->post_title . '</div>';
                endif; ?>
                <?php do_action('re_get_fields', get_the_ID()); ?>
            </div>
            <div class="col mb-4">
                <?php the_content(); ?>
            </div>
        </div>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
