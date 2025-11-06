<?php

add_action('admin_menu', 'simple_book_add_settings_page');
function simple_book_add_settings_page() {
    add_menu_page(
        'Simple Book Settings',
        'Simple Book',
        'manage_options',
        'simple-book-settings',
        'simple_book_render_settings_page',
        'dashicons-book',
        20
    );
}

function simple_book_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Simple Book Settings', 'simple-book'); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('simple_book_settings_group');
            do_settings_sections('simple-book-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'simple_book_register_settings');
function simple_book_register_settings() {
    register_setting('simple_book_settings_group', 'simple_book_option_name');
    register_setting('simple_book_settings_group', 'simple_book_option_email');
    register_setting('simple_book_settings_group', 'simple_book_option_status');
    register_setting('simple_book_settings_group', 'simple_book_option_location');
    register_setting('simple_book_settings_group', 'simple_book_option_type');
    register_setting('simple_book_settings_group', 'simple_book_option_description');

    add_settings_section(
        'simple_book_main_section',
        __('Main Settings', 'simple-book'),
        'simple_book_main_section_callback',
        'simple-book-settings',
    );

    add_settings_field('simple_book_option_name', __('Store Name', 'simple-book'), 'simple_book_option_name_cb', 'simple-book-settings', 'simple_book_main_section', ['label_for' => 'simple_book_option_name']);

    add_settings_field('simple_book_option_email', __('Store Email', 'simple-book'), 'simple_book_option_email_cb', 'simple-book-settings', 'simple_book_main_section', ['label_for' => 'simple_book_option_email']);

    add_settings_field('simple_book_option_status', __('Store Status', 'simple-book'), 'simple_book_option_status_cb', 'simple-book-settings', 'simple_book_main_section', ['label_for' => 'simple_book_option_status']);

    add_settings_field('simple_book_option_type', __('Store Type', 'simple-book'), 'simple_book_option_type_cb', 'simple-book-settings', 'simple_book_main_section');

    add_settings_field('simple_book_option_location', __('Store Location', 'simple-book'), 'simple_book_option_location_cb', 'simple-book-settings', 'simple_book_main_section');

    add_settings_field('simple_book_option_description', __('Store Description', 'simple-book'), 'simple_book_option_description_cb', 'simple-book-settings', 'simple_book_main_section');
}

function simple_book_main_section_callback() {
    echo "<p>Settings</p>";
}

function simple_book_option_name_cb($arg) {
    $option = get_option($arg["label_for"]);
    ?>
    <input type="text" id="<?php echo $arg['label_for']; ?>" name="<?php echo $arg['label_for']; ?>" value="<?php echo esc_attr($option); ?>" />
<?php
}

function simple_book_option_email_cb($arg) {
    $option = get_option($arg["label_for"]);
    ?>
    <input type="email" id="<?php echo $arg['label_for']; ?>" name="<?php echo $arg['label_for']; ?>" value="<?php echo esc_attr($option); ?>" />
<?php
}

function simple_book_option_status_cb($arg) {
    $option = get_option($arg["label_for"]);
    ?>
    <input type="checkbox" id="<?php echo $arg['label_for']; ?>" name="<?php echo $arg['label_for']; ?>" value="1" <?php checked('1', $option, true) ?> />
    <label for="<?php echo $arg['label_for']; ?>"><?php echo esc_html__('Open for Customer', 'simple-book'); ?></label>
<?php
}

function simple_book_option_type_cb() {
    $types = ['online' => 'Online', 'physical' => 'Physical', 'both' => 'Both'];
    $option = get_option('simple_book_option_type', 'online');

    foreach ($types as $type => $label) {
        ?>
        <input type="radio" id="<?php echo 'simple_book_option_type_' . $type; ?>" name="simple_book_option_type" value="<?php echo esc_attr($type); ?>" <?php checked($option, $type); ?> />
        <label for="<?php echo 'simple_book_option_type_' . $type; ?>"><?php echo esc_html__($label, 'simple-book'); ?></label>
        <?php
    }
    ?>
<?php
}

function simple_book_option_location_cb() {
    $locations = ['dhaka' => 'Dhaka', 'chittagong' => 'Chittagong', 'khulna' => 'Khulna'];
    $option = get_option('simple_book_option_location', 'dhaka');
    ?>
    <select name="simple_book_option_location">
        <?php 
        foreach ($locations as $location => $label) { ?>
            <option value="<?php echo esc_attr($location); ?>" <?php selected($option, $location) ?>><?php echo esc_html($label); ?></option>
        <?php } 
        ?>
    </select>
<?php
}

function simple_book_option_description_cb() {
    $text = get_option('simple_book_option_description');
    ?>
    <textarea name="simple_book_option_description" id="simple_book_option_description" rows="5" cols="50"><?php echo esc_html($text); ?></textarea>
<?php
}
