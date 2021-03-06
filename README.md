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
        class: ExamplePlugin\PageCallbacks
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
custom_fields:
  custom_field_settings_1:
    settings:
    - option_group: example_plugin_option_group
      option_name: text_example
      # callback: ExamplePlugin\CustomOptionGroupCallback
    - option_group: example_plugin_option_group
      option_name: text_example_2
    - option_group: example_plugin_option_group
      option_name: text_example_3
    sections:
    - id: example_plugin_index
      title: Settings
      # callback:
      #   class: ExamplePlugin\CustomSectionsCallback
      #   params: 
      #     desc: My admin panel settings
      page: example_plugin
    fields:
    - id: text_example
      title: Field 1 title
      # either type (builtin) or custom field is required
      # if both provided, custom gets higher priority
      callback:
        type: TextField
        # custom: ExamplePlugin\CustomTextField
        params:
          place_holder: Placeholder text 1 :)
      page: example_plugin
      section: example_plugin_index
      args:
    - id: text_example_2
      title: Field 2 title
      callback:
        type: TextField
      page: example_plugin
      section: example_plugin_index
      args:
    - id: text_example_3
      title: Field 3 title
      callback:
        type: TextArea
        params:
          col: 30
          row: 3
      page: example_plugin
      section: example_plugin_index
      args:
```