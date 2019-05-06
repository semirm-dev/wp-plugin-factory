<?php
namespace PluginFactory;

trait Base {

    /**
     * Get plugin directory name
     *
     * @return  string Directory name
     */
    private function pluginDir(): string {
        return plugin_basename(dirname(__FILE__, 4));
    }

    /**
     * Get plugin name
     *
     * @return  string  my-plugin/my-plugin.php
     */
    protected function pluginName(): string {
        $pluginDir = $this->pluginDir();
        
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
}