<?php
namespace PluginFactory;

/**
 * option_group callback
 *
 * @return  void  
 */
interface OptionGroupCallback {

    /**
     * Run callback
     * 
     * @param any  $input
     * 
     * @return any
     */
    public function run($input);
}