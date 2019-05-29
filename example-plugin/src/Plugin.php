<?php
namespace ExamplePlugin;

use PluginFactory\BasePlugin;

class Plugin extends BasePlugin {

    /**
     * @override
     *
     * @return  string  plugin_factory path
     */
    protected function pluginFactoryPath(): string {
        return plugin_dir_path(dirname(__FILE__)) . 'src/plugin_factory.yaml';
    }
}