<?php
namespace ExamplePlugin\CPT;

use PluginFactory\ServiceRegistrable;

/**
 * Custom post type
 */
class Book implements ServiceRegistrable {

    /**
     * @override
     *
     * @param   array  $options
     *
     * @return  void             
     */
    public function register(array $options): void {
        add_action('init', [$this, 'cpt']);
    }

    /**
     * Init hook
     *
     * @return  void 
     */
    public function cpt(): void {
        register_post_type('cpt_example', ['public' => true, 'label' => 'CPT Example']);
    }
}