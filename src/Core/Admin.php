<?php
namespace PluginFactory\Core;

use PluginFactory\ServiceRegistrable;
use PluginFactory\Base;

/**
 * Admin service will create admin pages and subpages, additional settings
 */
class Admin implements ServiceRegistrable {
    use Base;

    /**
     * Top level admin pages to add
     *
     * @var array Page
     */
    private $pages = [];

    /**
     * pluginLinks instance
     *
     * @var pluginLinks
     */
    private $pluginLinks;

    /**
     * Default empty constructor
     */
    public function __construct() {
        
    }

    /**
     * @override
     *
     * @param   array  $options  
     *
     * @return  void             
     */
    public function register(array $options): void {
        foreach ($options['pages'] as $pageOptions) {
            array_push($this->pages, $this->buildPage($pageOptions));
        }

        if (!empty($this->pages)) {
            add_action('admin_menu', [$this, 'menuPage']);
        } 

        if (isset($options['settings'])) {
            $this->pluginLinks = new PluginLinks();

            $this->pluginLinks->setTitle($options['settings']['settings_link_title'] ?? 'Settings');
            $this->pluginLinks->setLink($options['settings']['settings_link'] ?? 'admin.php');
            $this->pluginLinks->setSlug($options['settings']['settings_link_menu_slug'] ?? 'plugin_factory');

            $this->pluginLinks->apply();
        }
    }

    /**
     * Admin menu action hook
     * Loop through all pages and call add_menu_page
     *
     * @return  void 
     */
    public function menuPage(): void {
        foreach ($this->pages as $page) {
            add_menu_page(
                $page->getTitle(), 
                $page->getMenuTitle(), 
                $page->getCapability(), 
                $page->getMenuSlug(), 
                $page->getCallback(), 
                $page->getIconURL(), 
                $page->getPosition()
            );
        }
    }

    /**
     * Helper function to create page from available options
     *
     * @param   array  $pageOptions 
     *
     * @return  Page                  
     */
    private function buildPage(array $pageOptions): Page {
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