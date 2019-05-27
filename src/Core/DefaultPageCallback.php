<?php
namespace PluginFactory\Core;

/**
 * DefaultPageCallback is used when no page callback is provided in plugin_factory.php
 */
class DefaultPageCallback {

    /**
     * Template to display
     *
     * @return  void 
     */
    public function template(): void {
        echo '<h2>Default template</h2>';
    }
}