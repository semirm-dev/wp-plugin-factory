# Wordpress Plugin Factory

* [example-plugin/example-plugin.php](https://github.com/semirm-dev/wp-plugin-factory/blob/master/example-plugin/example-plugin.php)
```php
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
```

* [example-plugin/src/Plugin.php](https://github.com/semirm-dev/wp-plugin-factory/blob/master/example-plugin/src/Plugin.php)
```php
<?php
namespace ExamplePlugin;

use PluginFactory\BasePlugin;

class Plugin extends BasePlugin {

    /**
     * @override
     * 
     * Optionally, override default plugin_factory.yaml path
     *
     * @return  string  plugin_factory path
     */
    protected function pluginFactoryPath(): string {
        return plugin_dir_path(dirname(__FILE__)) . 'src/plugin_factory.yaml';
    }
}
```

* [example-plugin/src/SomePageCallback.php](https://github.com/semirm-dev/wp-plugin-factory/blob/master/example-plugin/src/SomePageCallback.php)
```php
<?php
namespace PluginFactory\Core;

class SomePageCallback {

    public function template(): void {
        echo '<h2>My template</h2>';
    }
}
```

* [example-plugin/src/plugin_factory.yaml](https://github.com/semirm-dev/wp-plugin-factory/blob/master/example-plugin/src/plugin_factory.yaml)
```yaml
services:
  PluginFactory\Core\Admin:
    pages:
    - title: Example Plugin
      menu_title: Example Plugin
      capability: manage_options
      menu_slug: example_plugin
      callback:
        class: ExamplePlugin\SomePageCallback
        func: template
      icon_url: dashicons-store
      position: 110
    links:
    - title: Visit Settings
      link: admin.php
      menu_slug: example_plugin
    - title: My link
      link: options-general.php
      menu_slug: example_plugin
  PluginFactory\Core\EnqueueScripts:
    # action: wp_enqueue_scripts
    scripts:
      handle: example_plugin_scripts
      src:
      - assets/scripts/m_script.js
    styles:
      handle: example_plugin_styles
      src:
      - assets/styles/m_style.css
  ExamplePlugin\CPT\Book: []
```