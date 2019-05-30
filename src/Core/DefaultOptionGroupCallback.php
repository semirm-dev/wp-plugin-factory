<?php
namespace PluginFactory\Core;

use PluginFactory\OptionGroupCallback;

class DefaultOptionGroupCallback implements OptionGroupCallback {

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