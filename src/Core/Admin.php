<?php
namespace PluginFactory\Core;

use PluginFactory\ServiceRegistrable;
use PluginFactory\Base;

/**
 * Admin service will create admin pages/settings
 */
class Admin implements ServiceRegistrable {
    use Base;

    /**
     * Settings instance
     *
     * @var Settings
     */
    private $settings;

    /**
     * Side-effect: Initialize new Settings
     */
    public function __construct() {
        $this->settings = new Settings();
    }

    /**
     * @override
     *
     * @param   array  $options  
     *
     * @return  void             
     */
    public function register(array $options): void {
        $pages = [];

        foreach ($options['pages'] as $pageOptions) {
            array_push($pages, $this->buildPage($pageOptions));
        }

        if (isset($options['settings'])) {
            $this->settings->setSettingsLinkTitle($options['settings']['settings_link_title'] ?? 'Settings');
            $this->settings->setSettingsLink($options['settings']['settings_link'] ?? 'admin.php');
            $this->settings->setAdminPageSlug($options['settings']['menu_slug'] ?? 'plugin_factory');
        }

        $this->settings->withPages($pages)->register();
    }

    /**
     * Helper function to create page from available options
     *
     * @param   array  $pageOptions 
     *
     * @return  Page                  
     */
    private function buildPage($pageOptions): Page {
        $page = new Page();

        $page->setTitle($pageOptions['title'] ?? 'Plugin Factory');
        $page->setMenuTitle($pageOptions['menu_title'] ?? 'Plugin Factory');
        $page->setCapability($pageOptions['capability'] ?? 'manage_options');
        $page->setMenuSlug($pageOptions['menu_slug'] ?? 'plugin_factory');
        $page->setCallback($pageOptions['callback'] ?? function() {});
        $page->setIconURL($pageOptions['icon_url'] ?? 'dashicons-store');
        $page->setPosition($pageOptions['position'] ?? 110);

        return $page;
    }
}