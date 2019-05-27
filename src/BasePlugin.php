<?php
namespace PluginFactory;

/**
 * Base class for plugins
 */
abstract class BasePlugin {
    use Base;

    /**
     * Plugin factory settings array
     *
     * @var array
     */
    private $pluginFactorySettings = [];

    /**
     * Path to plugin factory settings file
     */
    abstract protected function pluginFactoryPath(): string;

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
        $this->includePluginFactorySettings();

        foreach ($this->services() as $service => $options) {
            $serviceInstance = new $service;

            if ($serviceInstance instanceof ServiceContract) {

                $serviceInstance->register($options);
            }
        }
    }

    /**
     * Helper function to include/parse plugin factory settings file
     *
     * @return  void 
     */
    private function includePluginFactorySettings(): void {
        $factoryPath = $this->pluginFactoryPath();
        
        require_once($factoryPath);

        $this->pluginFactorySettings = $pluginFactorySettings;
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