<?php
namespace PluginFactory\Core;

use PluginFactory\Drawable;
use PluginFactory\OptionGroupCallback;
use PluginFactory\SectionsCallback;

/**
 * CustomFieldContractor is responsible to register custom fields from factory settings file
 */
class CustomFieldContractor {

    /**
     * Namespace where default custom fields implementations are located
     *
     * @var  string
     */
    private const CUSTOM_FIELDS_NAMESPACE = 'PluginFactory\\Core\\Fields\\';

    /**
     * Register custom fields
     *
     * @param   array  $options  Factory settings custom_fields options
     *
     * @return  void              
     */
    public function register($options): void {
        $this->registerSettings($options['settings']);

        $this->addSections($options['sections']);
        
        $this->addFields($options['fields']);
    }
    
    /**
     * Helper function to register settings
     * Call wordpress register_settings
     *
     * @param   array  $settingsOptions  Settings
     *
     * @return  void                     
     */
    private function registerSettings(array $settingsOptions): void {
        foreach ($settingsOptions as $settings) {
            $class = $settings['callback'] ?? self::CUSTOM_FIELDS_NAMESPACE . 'DefaultOptionGroupCallback';

            $classInstance = new $class();
            if (!($classInstance instanceof OptionGroupCallback)) {
                throw new \Exception("$class must be instance of PluginFactory\OptionGroupCallback");
            }

            register_setting($settings['option_group'], $settings['option_name'], [$classInstance, 'run']);
        }
    }

    /**
     * Helper function to add sections
     *
     * @param   array  $sectionOptions  Sections
     *
     * @return  void                    
     */
    private function addSections(array $sectionOptions): void {
        foreach ($sectionOptions as $section) {
            $class = $section['callback']['class'] ?? self::CUSTOM_FIELDS_NAMESPACE . 'DefaultSectionsCallback';

            $classInstance = new $class();
            if (!($classInstance instanceof SectionsCallback)) {
                throw new \Exception("$class must be instance of PluginFactory\SectionSCallback");
            }

            $params = $section['callback']['params'] ?? null;

            add_settings_section($section['id'], $section['title'], function() use ($classInstance, $params) {
                $classInstance->index($params);
            }, $section['page']);
        }
    }

    /**
     * Helper function to add fields
     *
     * @param   array  $fieldOptions  Fields
     *
     * @return  void                  
     */
    private function addFields(array $fieldOptions): void {
        foreach ($fieldOptions as $field) {
            $id = $field['id'];

            $class = $field['callback']['custom'] ?? self::CUSTOM_FIELDS_NAMESPACE . $field['callback']['type'] ?? null;
            $params = $field['callback']['params'] ?? null;

            if (is_null($class)) {
                throw new \Exception("Either callback.type or callback.custom must be provided!");
            }

            $classInstance = new $class();
            if (!($classInstance instanceof Drawable)) {
                throw new \Exception("$class must be instance of PluginFactory\Drawable");
            }

            add_settings_field($field['id'], $field['title'], function() use ($classInstance, $id, $params) {
                $classInstance->draw($id, $params);
            }, $field['page'], $field['section'], $field['args']);
        }
    }
}