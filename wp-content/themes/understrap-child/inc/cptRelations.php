<?php
add_action('add_meta_boxes', function () {
    add_meta_box('city_relationship', esc_html__('Город', 'understrap'), 'city_metabox', 'real_estate', 'side', 'low');
}, 1);

function city_metabox($post)
{
    $cities = get_posts(['post_type' => 'city', 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC']);

    if ($cities) {
        echo '
		<div style="max-height:200px; overflow:visible auto;">
			<ul>
		';

        foreach ($cities as $city) {
            echo '
			<li><label>
				<input type="radio" name="post_parent" value="' . $city->ID . '" ' . checked($city->ID, $post->post_parent, 0) . '> ' . esc_html($city->post_title) . '
			</label></li>
			';
        }

        echo '
			</ul>
		</div>';
    }
}