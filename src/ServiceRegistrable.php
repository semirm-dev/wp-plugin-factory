<?php
namespace PluginFactory;

/**
 * Services must implement this interface so they can be registered by base PluginFactory
 *
 * @return  void 
 */
interface ServiceRegistrable {
    public function register(array $options): void;
}