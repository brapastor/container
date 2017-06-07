<?php
/**
 * Created by PhpStorm.
 * User: brapastor
 * Date: 6/7/17
 * Time: 5:09 PM
 */

namespace brapastor\Container;


class Application
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    public function registerProviders(array $providers){
        foreach ($providers as $provider){
            $provider = new $provider($this->container);
            $provider->register();
        }
    }
}



