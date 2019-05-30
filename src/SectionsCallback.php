<?php
namespace PluginFactory;

/**
 * sections callback
 *
 * @return  void  
 */
interface SectionsCallback {

    /**
     * Run callback
     * 
     * @param array  $params
     * 
     * @return void
     */
    public function index(array $params = null): void;
}