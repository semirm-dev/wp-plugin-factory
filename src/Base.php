<?php
namespace PluginFactory;

trait Base {

    /**
     * Get plugin name
     *
     * @return  string  my-plugin/my-plugin.php
     */
    protected function pluginName(): string {
        $pluginDir = $this->pluginDirName();
        
        return $pluginDir . '/' . $pluginDir . '.php';
    }

    /**
     * Get plugin URL
     *
     * @return  string  Plugin URL
     */
    protected function pluginURL(): string {
        return plugin_dir_url(dirname(__FILE__, 3));
    }

    /**
     * Default path to factory settings file
     * plugin-name/src/plugin_factory.yaml
     *
     * @return  string  Path
     */
    protected function defaultSettingsPath(): string {
        return plugin_dir_path(dirname(__FILE__, 4)) . $this->pluginDirName() . '/src/plugin_factory.yaml';
    }

    /**
     * Get plugin directory name
     *
     * @return  string Directory name
     */
    private function pluginDirName(): string {
        return plugin_basename(dirname(__FILE__, 4));
    }
}