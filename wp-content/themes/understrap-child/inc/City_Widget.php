<?php

class City_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'city-widget',  // Base ID
            'Cities'   // Name
        );
        add_action('widgets_init', function () {
            register_widget('City_Widget');
        });
    }

    public $args = array(
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget' => '</div></div>',
    );

    public function widget($args, $instance)
    {
        $cities = get_posts(['post_type' => 'city', 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC']);
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo '<ul class="textwidget list-group">';
        if ($cities) {
            foreach ($cities as $city) {
                $children = get_posts([
                    'posts_per_page' => -1,
                    'post_type' => 'real_estate',
                    'post_status'=> ['publish'],
                    'post_parent'=>$city->ID
                ]);
                if ($children) {
                    $count = count($children);
                    $link = get_permalink($city->ID);
                    echo "<li class='list-group-item'><a href='$link'>$city->post_title ($count)</a></li>";
                }
            }
        } else {
            echo esc_html__('Городов не найдено', 'understrap');
        }
        echo '</ul>';
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'understrap');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}