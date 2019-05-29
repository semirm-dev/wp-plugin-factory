<?php
namespace ExamplePlugin\Core;

class FieldCallbacks {

    public function optionGroup($input) {
        return $input;
    }

    public function indexSection(array $params) {
        echo $params['title'] ?? 'My title default';
    }

    public function textField(string $id, array $params) {
        $val = esc_attr(get_option($id));
        $placeHolder = esc_attr($params['place_holder'] ?? 'My placeholder default');

        echo '<input type="text" class="regular-text" name="' . $id . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}