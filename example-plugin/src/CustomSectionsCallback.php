<?php
namespace ExamplePlugin;

use PluginFactory\SectionsCallback;

class CustomSectionsCallback implements SectionsCallback {

    /**
     * @override
     *
     * @param   array  $params  
     *
     * @return  void            
     */
    public function index(array $params = null): void {
        echo 'My custom sections title';
    }
}