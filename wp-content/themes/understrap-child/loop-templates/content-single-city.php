<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$children = get_posts([
    'posts_per_page' => 10,
    'post_type' => 'real_estate',
    'post_status' => ['publish'],
    'post_parent' => get_the_ID()
]);

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header mb-4">

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

    </header><!-- .entry-header -->
    <div class="mb-4">
        <?php echo get_the_post_thumbnail($post->ID, 'large', ); ?>
    </div>
    <div class="entry-content mb-4">
        <?php the_content(); ?>
    </div><!-- .entry-content -->
    <?php if ($children): ?>
    <div class="row">
        <div class="col-12 mb-4">
            <h3><?php esc_html_e('Последние опубликованные', 'understrap'); ?></h3>
        </div>
        <?php
        global $post;

        foreach ($children as $post) {
            setup_postdata($post);

            get_template_part( 'loop-templates/content-real_estate');
        }

        wp_reset_postdata(); // сброс
        ?>
    </div>
    <?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
