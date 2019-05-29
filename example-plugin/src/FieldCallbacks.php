<?php
namespace RedisManager;

class FieldCallbacks {

    public function customOptionGroup($input) {
        return $input;
    }

    public function customIndexSection(array $params = null) {
        echo $params['title'] ?? 'My title default';
    }

    public function customTextField(string $id, array $params = null) {
        $val = esc_attr(get_option($id));
        $placeHolder = esc_attr($params['place_holder'] ?? 'My placeholder default');

        echo '<input type="text" class="regular-text" name="' . $id . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}