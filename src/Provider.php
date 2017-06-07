<?php
namespace brapastor\Container;

/**
 * Created by PhpStorm.
 * User: brapastor
 * Date: 6/7/17
 * Time: 5:22 PM
 */
abstract class Provider{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function register();
}