<?php
namespace PluginFactory\Core;

/**
 * NullPageCallbacks is used when no page callback is provided in plugin_factory settings file
 */
class NullPageCallbacks {

    /**
     * Template to display
     *
     * @return  void 
     */
    public function mainPageTemplate(): void {
        echo '<h2>Default template. Consider using your own!</h2>';
    }
}