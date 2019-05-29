<?php
namespace PluginFactory\Core;

/**
 * CustomFieldContractor is responsible to register custom fields from factory settings file
 */
class CustomFieldContractor {

    /**
     * Namespace where default fields are located
     *
     * @var  string
     */
    private const FIELDS_NAMESPACE = 'PluginFactory\\Core\\';

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
     * Default callback for options group
     *
     * @param   mix  $input
     *
     * @return  mix         
     */
    public function optionsGroup($input) {
        return $input;
    }

    /**
     * Default callback for section
     *
     * @param   array  $params  Params to pass
     *
     * @return  void          
     */
    public function indexSection(array $params = null) {
        echo '';
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
            $class = $this;
            $func = 'optionsGroup';

            if (isset($settings['callback']['class']) && isset($settings['callback']['func'])) {
                $class = new $settings['callback']['class'];
                $func = $settings['callback']['func'];
            }

            register_setting($settings['option_group'], $settings['option_name'], [$class, $func]);
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
            $class = $this;
            $func = 'indexSection';

            if (isset($section['callback']['class']) && isset($section['callback']['func'])) {
                $class = new $section['callback']['class'];
                $func = $section['callback']['func'];
            }

            $params = $section['callback']['params'] ?? null;

            add_settings_section($section['id'], $section['title'], function() use ($class, $func, $params) {
                call_user_func_array([$class, $func], [$params]);
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

            $class = $field['callback']['class'] ?? null;
            $func = $field['callback']['func'] ?? '';
            $params = $field['callback']['params'] ?? null;

            if (isset($field['callback']['type'])) {
                $class = self::FIELDS_NAMESPACE . $field['callback']['type'];
                $func = 'draw';
            }

            add_settings_field($field['id'], $field['title'], function() use ($class, $func, $id, $params) {
                call_user_func_array([new $class(), $func], [$id, $params]);
            }, $field['page'], $field['section'], $field['args']);
        }
    }
}