<?php
namespace PluginFactory;

/**
 * Services must implement this interface so they can be registered by base PluginFactory
 *
 * @return  void 
 */
interface ServiceContract {

    /**
     * Register service
     * 
     * @param array $options Pass options to service registration
     */
    public function register(array $options): void;
}