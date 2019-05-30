<?php
namespace ExamplePlugin;

use PluginFactory\OptionGroupCallback;

class CustomOptionGroupCallback implements OptionGroupCallback {

    /**
     * @override
     *
     * @param   array  $input  
     *
     * @return  array           
     */
    public function run($input) {
        return $input;
    }
}