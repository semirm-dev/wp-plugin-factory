<?php
namespace PluginFactory\Core;

use PluginFactory\ServiceRegistrable;
use PluginFactory\Base;

/**
 * Service to enqueue scripts (js, css)
 */
class EnqueueScripts implements ServiceRegistrable {
    use Base;

    /**
     * Passed options
     *
     * @var array
     */
    private $options = [];

    /**
     * @override
     *
     * @param   array  $options 
     *
     * @return  void             
     */
    public function register(array $options = null): void {
        $this->options = $options;

        add_action($this->options['action'] ?? 'admin_enqueue_scripts', [$this, 'enqueue']);
    }

    /**
     * Enqueue scripts and styles
     *
     * @return  void 
     */
    public function enqueue(): void {
        if (isset($this->options['scripts']) && 
            isset($this->options['scripts']['handle']) && 
            isset($this->options['scripts']['src']) && 
            count($this->options['scripts']['src']) > 0) {

                foreach ($this->options['scripts']['src'] as $script) {
                    wp_enqueue_script($this->options['scripts']['handle'], $this->pluginURL() . $script);
                }
        }

        if (isset($this->options['styles']) && 
            isset($this->options['styles']['handle']) && 
            isset($this->options['styles']['src']) && 
            count($this->options['styles']['src']) > 0) {

                foreach ($this->options['styles']['src'] as $style) {
                    wp_enqueue_style($this->options['styles']['handle'], $this->pluginURL() . $style);
                }
        }
    }
}