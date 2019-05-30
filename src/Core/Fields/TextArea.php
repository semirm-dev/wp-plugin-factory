<?php
namespace PluginFactory\Core\Fields;

use PluginFactory\Drawable;

/**
 * Default implementation for text area
 */
class TextArea implements Drawable {

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
        $col = $params['col'] ?? 50;
        $row = $params['row'] ?? 5;

        echo '<textarea cols="' . $col . '" rows="' . $row . '" class="regular-text" name="' . $id . '">' . $val . '</textarea>';
    }
}