<?php
use brapastor\Container\Container;
use brapastor\Container\ContainerException;

/**
 * Created by PhpStorm.
 * User: brapastor
 * Date: 6/5/17
 * Time: 5:52 PM
 */
class ContainerTest extends PHPUnit\Framework\TestCase
{

    public function test_bind_from_closure()
    {

        $container = new Container();

        $container->bind('key', function () {
            return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));

    }

    public function test_bind_instance()
    {

        $container = new Container();

        $stdClass = new StdClass();

        $container->instance('key', $stdClass);

        $this->assertSame($stdClass, $container->make('key'));
    }


    public function test_singleton_instance(){

        $container = new Container();

        $container->singleton('foo', 'Foo');

        $this->assertSame(
          $container->make('foo'),
          $container->make('foo')
        );

    }


    public function test_bind_from_class_name()
    {
        $container = new Container();

        $container->bind('key', 'StdClass');

        $this->assertInstanceOf('StdClass', $container->make('key'));

    }


    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();

        $container->bind('foo', 'Foo');

        $this->assertInstanceOf('Foo', $container->make('foo'));

    }

//    /**
//     * @expectedException brapastor\Container\ContainerException
//     * @expectedExceptionMessage  Unable to build [Qux]: Class Norf does not exist
//     */
//    public function test_expected_container_if_dependency_does_not_exist(){
//
//        $container = new Container();
//
//        $container->bind('qux', 'Qux');
//
//        $container->make('qux');
//    }
//
//    /**
//     * @expectedException brapastor\Container\ContainerException
//     *
//     */
//    public function test_class_does_not_exits(){
//
//        $container = new Container();
//
//        $container->make('Norf');
//    }

    public function test_container_make_with_arguments()
    {

        $container = new Container();

        $this->assertInstanceOf(
            MailDummy::class,
            $container->make('MailDummy', ['url' => 'brapastor.net', 'key' => 'secret']));
    }

    public function excercise_test_container_make_with_default_arguments()
    {

        $container = new Container();

        $this->assertInstanceOf(
            MailDummy::class,
            $container->make('MailDummy', ['url' => 'brapastor.net']));
    }
}

class MailDummy
{

    private $url;
    private $key;

    public function __construct($url, $key = 'secret')
    {
        $this->url = $url;
        $this->key = $key;
    }


}

class Foo
{
    public function __construct(Bar $bar, Baz $baz)
    {

    }
}

class Bar
{
    public function __construct(FooBar $fooBar)
    {
    }
}

class FooBar
{
}

class Baz
{
}
class Qux{
    public function __construct(Norf $norf)
    {
    }
}