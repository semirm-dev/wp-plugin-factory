<?php
namespace PluginFactory\Core\Fields;

use PluginFactory\Drawable;

/**
 * Default implementation for text field
 */
class TextField implements Drawable {

    /**
     * @override
     *
     * @param   string  $id      
     * @param   array   $params  
     *
     * @return  void             
     */
    public function draw(string $id, array $params = null): void {
        $val = esc_attr(get_option($id));
        $placeHolder = esc_attr($params['place_holder'] ?? '');

        echo '<input type="text" class="regular-text" name="' . $id . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}