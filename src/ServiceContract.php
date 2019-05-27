<?php
namespace PluginFactory;

/**
 * Services must implement this interface so they can be registered by base PluginFactory
 *
 * @return  void 
 */
interface ServiceContract {
    public function register(array $options): void;
}