<?php
namespace PluginFactory\Core;

use PluginFactory\Base;

/**
 * Plugin links (settings, etc.)
 */
class PluginLinks {
    use Base;

    /**
     * Link title
     *
     * @var string
     */
    private $title = '';

    /**
     * Link to wordpress page (admin.php, options-general.php)
     *
     * @var string
     */
    private $link = '';

    /**
     * Page slug for link
     *
     * @var string
     */
    private $slug = '';

    /**
     * Hook for plugin_action_links_*
     * Construct links for plugin
     *
     * @param   array  $links   Current plugin links (defaults)
     *
     * @return  array          
     */
    public function links(array $links): array {
        $linkURL = '<a href="' . $this->link . '?page=' . $this->slug . '">' . $this->title . '</a>';

        array_push($links, $linkURL);

        return $links;
    }

    /**
     * Apply links to plugin
     *
     * @return  void 
     */
    public function apply(): void {
        add_filter('plugin_action_links_' . $this->pluginName(), [$this, 'links']);
    }

    // setters
    
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setLink(string $link): void {
        $this->link = $link;
    }

    public function setSlug(string $slug): void {
        $this->slug = $slug;
    }
}