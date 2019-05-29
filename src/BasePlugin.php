<?php
namespace PluginFactory;

use Symfony\Component\Yaml\Yaml;

/**
 * Base class for plugins
 */
abstract class BasePlugin {
    use Base;

    /**
     * Plugin factory settings
     *
     * @var array
     */
    private $pluginFactorySettings = [];

    /**
     * Path to plugin factory settings file
     */
    protected function pluginFactoryPath(): string {
        return $this->defaultSettingsPath();
    }

    /**
     * Activate plugin
     *
     * @return  void 
     */
    public function activate(): void {
        flush_rewrite_rules();
    }

    /**
     * Deactivate plugin
     *
     * @return  void  
     */
    public function deactivate(): void {
        flush_rewrite_rules();
    }

    /**
     * Register services found in pluginFactorySettings
     *
     * @return  void 
     */
    public function register(): void {
        $this->pluginFactorySettings = Yaml::parseFile($this->pluginFactoryPath());

        foreach ($this->services() as $service => $options) {
            $serviceInstance = new $service();

            if ($serviceInstance instanceof ServiceContract) {

                $serviceInstance->register($options);
            }
        }
    }

    /**
     * Helper function get services from plugin factory settings file
     *
     * @return  array  Array of services + options
     */
    private function services(): array {
        return $this->pluginFactorySettings['services'];
    }
}