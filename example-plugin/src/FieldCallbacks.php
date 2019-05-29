<?php
namespace ExamplePlugin\Core;

class FieldCallbacks {

    public function optionGroup(array $params) {
        // code
    }

    public function indexSection(array $params) {
        echo $params['title'] ?? 'My title default';
    }

    public function textField(array $params) {
        $val = esc_attr(get_option($params['id']));
        $placeHolder = esc_attr($params['place_holder'] ?? 'My placeholder default');

        echo '<input type="text" class="regular-text" name="' . $params['id'] . '" value="' . $val . '" placeholder="' . $placeHolder . '"/>';
    }
}