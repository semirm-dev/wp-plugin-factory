<?php
namespace PluginFactory\Core;

use PluginFactory\SectionsCallback;

class DefaultSectionsCallback implements SectionsCallback {

    /**
     * @override
     *
     * @param   array  $params  
     *
     * @return  void            
     */
    public function index(array $params = null): void {
        echo $params['desc'] ?? '';
    }
}