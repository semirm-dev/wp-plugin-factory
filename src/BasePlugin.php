<?php
namespace PluginFactory;

use Symfony\Component\Yaml\Yaml;
use PluginFactory\Core\CustomFieldContractor;

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
        register_activation_hook(__FILE__, [$this, 'activate']);

        register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        $this->pluginFactorySettings = Yaml::parseFile($this->pluginFactoryPath());

        $this->registerServices();

        $this->registerCustomFields();
    }

    /**
     * Helper function to register services
     *
     * @return  void 
     */
    private function registerServices(): void {
        foreach ($this->services() as $service => $options) {
            $serviceInstance = new $service();

            if ($serviceInstance instanceof ServiceContract) {

                $serviceInstance->register($options);
            }
        }
    }

    /**
     * Helper function to register custom fields
     *
     * @return  void 
     */
    private function registerCustomFields(): void {
        $fieldContractor = new CustomFieldContractor();

        foreach ($this->customFields() as $field => $options) {
            add_action('admin_init', function() use ($fieldContractor, $options) {
                $fieldContractor->register($options);
            });
        }
    }

    /**
     * Helper function to get services from plugin factory settings file
     *
     * @return  array  Array of services + options
     */
    private function services(): array {
        return $this->pluginFactorySettings['services'];
    }

    /**
     * Helper function to get custom fields from plugin factory settings file
     *
     * @return  array  Array of custom fields
     */
    private function customFields(): array {
        return $this->pluginFactorySettings['custom_fields'];
    }
}