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
     * Links for plugin
     *
     * @var array
     */
    private $links = [];

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
        if (isset($options['pages'])) {
            $this->addPages($options['pages']);
        }
        
        if (isset($options['links'])) {
            $this->applyLinks($options['links']);
        }
    }

    /**
     * Action hook to add main menu pages
     * Loop through all pages and call add_menu_page
     *
     * @return  void 
     */
    public function mainMenuPages(): void {
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
     * Helper function at add main menu pages
     *
     * @param   array  $pages  Pages to add
     *
     * @return  void           
     */
    private function addPages(array $pages): void {
        if (!empty($pages)) {
            foreach ($pages as $pageOptions) {
                array_push($this->pages, $this->buildPage($pageOptions));
            }

            if (!empty($this->pages)) {
                add_action('admin_menu', [$this, 'mainMenuPages']);
            } 
        }
    }

    /**
     * Helper function to apply plugin links
     *
     * @param   array  $links  Links to apply
     *
     * @return  void           
     */
    private function applyLinks(array $links): void {
        if (!empty($links)) {
            foreach ($links as $link) {
                $pluginLinks = new PluginLinks();

                $pluginLinks->setTitle($link['link_title'] ?? 'Settings');
                $pluginLinks->setLink($link['link'] ?? 'admin.php');
                $pluginLinks->setSlug($link['link_menu_slug'] ?? 'plugin_factory');

                $pluginLinks->apply();
            }
        }
    }

    /**
     * Helper function to create page from available page options
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