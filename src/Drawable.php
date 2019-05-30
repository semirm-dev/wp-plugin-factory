<?php
namespace PluginFactory;

/**
 * Contract for fields
 *
 * @return  void  
 */
interface Drawable {

    /**
     * Draw field
     * 
     * @param string $id        Field id
     * @param array  $params    Params for field
     * 
     * @return void
     */
    public function draw(string $id, array $params = null): void;
}