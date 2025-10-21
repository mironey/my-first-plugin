<?php 
/**
 * Plugin Name: My First Plugin
 * Description: A simple WordPress plugin to demonstrate code completion.
 * Version: 1.0
 * Author: Mohidul Islam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function activation_plugin() {
    error_log( 'My First Plugin activated.' );
}
register_activation_hook( __FILE__, 'activation_plugin' );
