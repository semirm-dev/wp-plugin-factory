<?php
namespace PluginFactory\Core;

use PluginFactory\ServiceRegistrable;
use PluginFactory\Base;

/**
 * Main logic to add admin menu/page
 */
class Settings {
    use Base;

    /**
     * Admin pages to add
     *
     * @var array Page
     */
    private $pages = [];

    /**
     * Settings link title
     *
     * @var string
     */
    private $settingsLinkTitle = '';

    /**
     * Settings link (admin.php, options-general.php)
     *
     * @var string
     */
    private $settingsLink = '';

    /**
     * Admin page slug, used in url/link
     *
     * @var string
     */
    private $adminPageSlug = '';

    /**
     * @override
     *
     * @param   array  $options 
     *
     * @return  void             
     */
    public function register(array $options = null): void {
        if (!empty($this->pages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);

            add_filter('plugin_action_links_' . $this->pluginName(), [$this, 'settingsLinks']);
        } 
    }

    /**
     * Pages to add
     *
     * @param   array     $pages  Page
     *
     * @return  Settings          
     */
    public function withPages(array $pages): Settings {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Admin menu action hook
     * Loop through all pages and call add_menu_page
     *
     * @return  void 
     */
    public function addAdminMenu(): void {
        foreach ($this->pages as $page) {
            add_menu_page(
                $page->getTitle(), 
                $page->getMenuTitle(), 
                $page->getCapability(), 
                $page->getMenuSlug(), 
                [$page, 'getCallback'], 
                $page->getIconURL(), 
                $page->getPosition()
            );
        }
    }

    /**
     * Hook for plugin_action_links_*
     * Add Settings link to plugin
     *
     * @param   array  $links   Current plugin links (defaults)
     *
     * @return  array          
     */
    public function settingsLinks(array $links): array {
        $settingsLink = '<a href="' . $this->settingsLink . '?page=' . $this->adminPageSlug . '">' . $this->settingsLinkTitle . '</a>';

        array_push($links, $settingsLink);

        return $links;
    }

    // setters
    
    public function setSettingsLinkTitle(string $settingsLinkTitle): void {
        $this->settingsLinkTitle = $settingsLinkTitle;
    }

    public function setSettingsLink(string $settingsLink): void {
        $this->settingsLink = $settingsLink;
    }

    public function setAdminPageSlug(string $slug): void {
        $this->adminPageSlug = $slug;
    }
}