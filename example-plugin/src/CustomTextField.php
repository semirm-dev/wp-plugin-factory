<?php
namespace ExamplePlugin;

use PluginFactory\Drawable;

class CustomTextField implements Drawable {

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
        $placeHolder = esc_attr($params['place_holder'] ?? 'My placeholder default');

        echo '<input type="text" class="regular-text" name="' . $id . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}