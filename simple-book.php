<?php
/**
 * Plugin Name: Simple Book
 * Description: A simple WordPress plugin to show book
 * Plugin URI: https://example.com/simple-book/
 * Version: 1.0
 * Author: Mohidul Islam
 * Author URI: https://example.com/
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Licnest: GPL V2 or Later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-book
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require_once plugin_dir_path(__FILE__) . 'includes/simple-book-settings.php';

add_action('init', 'simple_book_init');
function simple_book_init() {
    $arguments = [
        'labels' => [
            'name' => __('Books', 'simple-book'),
            'singular_name' => __('Book', 'simple-book'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'books'],
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
    ];
    register_post_type('simple_book', $arguments);

    register_taxonomy('book-author', 'simple_book', [
        'labels' => [
            'name' => __('Authors', 'simple-book'),
            'singular_name' => __('Author', 'simple-book'),
        ],
        'public' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'book-authors'],
        'show_ui' => true,
        'show_in_rest' => true,
    ]);
}

add_filter('template_include', 'simple_book_template_include');
function simple_book_template_include($template) {
    if (is_post_type_archive('simple_book')) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/book-archive.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
        echo "Hello";
    }

    if ( is_singular( 'simple_book' )) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/singular-book.php';
        if ( file_exists( $new_template ) ) {
            return $new_template;
        }
    }   

    return $template;
}




