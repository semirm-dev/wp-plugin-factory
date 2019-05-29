<?php
namespace PluginFactory\Core\Fields;

/**
 * Default implementation for text area
 */
class TextArea {

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
        $col = $params['col'] ?? 50;
        $row = $params['row'] ?? 5;

        echo '<textarea cols="' . $col . '" rows="' . $row . '" class="regular-text" name="' . $id . '">' . $val . '</textarea>';
    }
}