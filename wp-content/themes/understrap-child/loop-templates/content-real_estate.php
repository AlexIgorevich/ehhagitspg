<?php
$city = get_post_parent() ?? '';

?>
<div class="col-12 col-md-6 mb-4">
    <div class="card">
        <div class="card-image">
            <?php echo has_post_thumbnail()? get_the_post_thumbnail( get_the_ID(), 'large', array('class' => 'card-img-top') ) : '<img src="'.get_stylesheet_directory_uri().'/img/placeholder.svg" class="card-img-top" alt="'.get_the_title().'">'; ?>
        </div>
        <?php echo $city ? '<div class="card-badge"><span class="badge bg-primary">'.$city->post_title.'</span></div>': '' ?>
        <div class="card-body">
            <h6 class="card-title"><?php the_title(); ?></h6>
            <?php do_action('re_get_fields', get_the_ID()); ?>
            <a href="<?php echo get_permalink(); ?>" class="card-link"><?php esc_html_e('Подробнее', 'understrap'); ?></a>
        </div>
    </div>
</div>

