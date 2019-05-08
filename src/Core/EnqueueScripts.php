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

                $this->enqueueJs($this->options['scripts']['handle'], $this->options['scripts']['src']);
        }

        if (isset($this->options['styles']) && 
            isset($this->options['styles']['handle']) && 
            isset($this->options['styles']['src']) && 
            count($this->options['styles']['src']) > 0) {

                $this->enqueueStyles($this->options['styles']['handle'], $this->options['styles']['src']);
        }
    }

    /**
     * Helper function to enqueue Js scripts
     *
     * @param   string  $handle 
     * @param   array   $scripts
     *
     * @return  void            
     */
    private function enqueueJs(string $handle, array $scripts): void {
        foreach ($scripts as $script) {
            wp_enqueue_script($handle, $this->pluginURL() . $script);
        }
    }

    /**
     * Helper function to enqueue styles
     *
     * @param   string  $handle  
     * @param   array   $styles  
     *
     * @return  void             
     */
    private function enqueueStyles(string $handle, array $styles): void {
        foreach ($styles as $style) {
            wp_enqueue_style($handle, $this->pluginURL() . $style);
        }
    }
}