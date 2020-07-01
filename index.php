<?php

/*
    Plugin Name: Bexs Checkout Box
    Plugin URI: guidiego.github.io/bexs-checkout-box
    Description: That's pluggin add Bexs Configurations and a shortcode to add Checkout Boxes into yous posts.
    Version: 1.0
    Author: Guilherme Diego
    License: MIT License
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

$pluginPath = plugin_dir_path(__FILE__);
include_once($pluginPath . 'lib/wp-admin/index.php');
include_once($pluginPath . 'lib/shortcode/index.php');
include_once($pluginPath . 'lib/api/index.php');

register_activation_hook(__FILE__, 'bcbCreateTable');
register_deactivation_hook(__FILE__, 'bcbDropTable');
