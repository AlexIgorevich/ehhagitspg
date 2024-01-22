<?php
$cities = get_posts([
    'posts_per_page' => -1,
    'post_type' => 'city',
    'post_status' => ['publish'],
    'orderby' => 'post_title',
    'order' => 'ASC'

]);

$types = get_terms([
    'taxonomy' => 'estate_taxonomy',
    'hide_empty' => false,
]);
?>

<div class="col-12">
    <h2 class="mb-4"><?php echo $args['name']; ?></h2>
    <form class="new-object needs-validation" novalidate>
        <div class="row">
            <div class="col-12">
                <div class="mb-3 has-validation">
                    <label for="name" class="form-label"><?php esc_html_e('Название объекта', 'understrap'); ?></label>
                    <input type="text" class="form-control"
                           name="name" id="name" required>
                    <div class="invalid-feedback">
                        <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                    </div>
                </div>
            </div>
            <?php if ($types): ?>
                <div class="col-12 col-md-6">
                    <div class="mb-3 has-validation">
                        <label for="type"
                               class="form-label"><?php esc_html_e('Тип недвижимости', 'understrap'); ?></label>
                        <select class="form-select" name="type" id="type" required>
                            <option selected></option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?php echo $type->term_id ?>"><?php echo $type->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($cities): ?>
                <div class="col-12 col-md-6">
                    <div class="mb-3 has-validation">
                        <label for="city" class="form-label"><?php esc_html_e('Город', 'understrap'); ?></label>
                        <select class="form-select" name="city" id="city" required>
                            <option selected></option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?php echo $city->ID ?>"><?php echo $city->post_title ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <div class="mb-3 has-validation">
                    <label for="address" class="form-label"><?php esc_html_e('Адрес', 'understrap'); ?></label>
                    <input type="text" class="form-control"
                           name="address" id="address" required>
                    <div class="invalid-feedback">
                        <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="mb-3 has-validation">
                    <label for="square" class="form-label"><?php esc_html_e('Общая площадь', 'understrap'); ?></label>
                    <input type="number" class="form-control"
                           name="square" id="square" min="1" max="999" required>
                    <div class="invalid-feedback">
                        <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="mb-3">
                    <label for="living_space"
                           class="form-label"><?php esc_html_e('Жилая площадь', 'understrap'); ?></label>
                    <input type="number" class="form-control"
                           name="living_space" id="living_space" min="1" max="999">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="mb-3 has-validation">
                    <label for="floor" class="form-label"><?php esc_html_e('Этаж', 'understrap'); ?></label>
                    <input type="number" class="form-control"
                           name="floor" id="floor" min="1" max="100">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="mb-3 has-validation">
                    <label for="price" class="form-label"><?php esc_html_e('Цена ($)', 'understrap'); ?></label>
                    <input type="number" class="form-control"
                           name="price" id="price" min="1" max="9999999" required>
                    <div class="invalid-feedback">
                        <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 has-validation">
                    <label for="image"
                           class="form-label"><?php esc_html_e('Фотография объекта', 'understrap'); ?></label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg"
                           required>
                    <div class="invalid-feedback">
                        <?php esc_html_e('Обязательное поле', 'understrap'); ?>
                    </div>
                    <div class="form-text">
                        <?php esc_html_e('Главное изображение записи, галерею можно добавить через админку, для формы хватит и этого в рамках тестового задания.', 'understrap'); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 form-bottom">
                <input type="hidden" name="action" value="re_add_new_object">
                <?php wp_nonce_field('re_form_nonce') ?>
                <button class="btn btn-primary" type="submit"><?php esc_html_e('Отправить на модерацию', 'understrap'); ?></button>
                <div class="invalid-feedback system"></div>
            </div>
        </div>
        <div class="form-success-msg">
            <p><?php esc_html_e('Объявление отправлено на валидацию', 'understrap'); ?></p>
        </div>
    </form>
</div>
