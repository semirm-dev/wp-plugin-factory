<?php
/**
 * @package ExamplePlugin
 */

/** 
 * Plugin Name: Example Plugin
 * Plugin URI:  https://my.url/example-plugin
 * Description: Example Plugin description
 * Version:     1.0.0
 * Author:      Semir Mahovkic
 * Author URI:  https://github.com/semirm-dev
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: example-plugin
 */

defined('ABSPATH') or die('you are so wrong');

require_once dirname(__FILE__) . '/vendor/autoload.php';

use ExamplePlugin\Plugin;

$plugin = new Plugin();

register_activation_hook(__FILE__, [$plugin, 'activate']);

register_deactivation_hook(__FILE__, [$plugin, 'deactivate']);

$plugin->register();