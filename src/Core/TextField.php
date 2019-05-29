<?php
namespace PluginFactory\Core;

/**
 * Default implementation for text field
 */
class TextField {

    /**
     * Callback to call on add_settings_field hook
     *
     * @param   string  $id      Field id, corresponds to settings.option_name
     * @param   array   $params  Params to pass
     *
     * @return  void             
     */
    public function draw(string $id, array $params = null): void {
        $val = esc_attr(get_option($id));
        $placeHolder = esc_attr($params['place_holder'] ?? '');

        echo '<input type="text" class="regular-text" name="' . $id . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}