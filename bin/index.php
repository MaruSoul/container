<?php

use Container\Container;

require_once __DIR__ . '/../vendor/autoload.php';


// this code shows how you can to use the container:
class A
{
    public function __construct(public B $b, int $num)
    {
        
    }

    public function print()
    {
        echo PHP_EOL, $this->b->someText(), PHP_EOL;
    }
}

class B
{
    public function someText()
    {
        return 'Hello world';
    }
}

$container = new Container();

$container->add('key1', 'value1')->addTag('test');
$container->add('key2', 'value2')->addTag('test');
$container->add('key3', 'value3')->addTag('test');
$container->add('key4', 'value4')->addTag('test');

$container->add('num', 5);

$container->add(
    A::class, 
    fn() => new A(
        $container->get(B::class),
        $container->get('num'),
    ),
)->addTag('test1');

$container->add(
    B::class, 
    fn() => new B(),
)->addTag('test1');

$container->get(A::class)->print();
