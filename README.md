# Container
This project is example my work for portfolio. Container is dependency injection container. It allows you to implement the dependency injection design pattern meaning that you can decouple your class dependencies and have the container inject them where they are needed.

## Global usage

Your code:

```php
<?php

class Сooker implements СookerInterface
{
    // some code
}

class Fridge implements FridgeInterface
{
    // some code
}

class Kitchen
{
    public function __construct(
        protected СookerInterface $cooker,
        protected FridgeInterface $fridge,
        protected int $area,
        )
    {      
    }

    public function getArea(): int
    {
        return $this->area;
    }
}
```

Injecting a dependency with DIContainer:

```php
<?php

use Container\Container;

$container = new Container();

$container->add('kitchenArea', 666)->addTag('apartment');

$container->add(СookerInterface::class, 
        fn() => new Сooker()
    )->addTag('apartment');

$container->add(FridgeInterface::class, 
        fn() => new Fridge()
    )->addTag('apartment');

$container->add(Kitchen::class, 
        fn() => new Kitchen(
            $container->get(СookerInterface::class),
            $container->get(FridgeInterface::class),
            $container->get('kitchenArea'),
        )
    )->addTag('apartment');
```

*Some moments later:*

```php
<?php

if ($container->get(Kitchen::class)->getArea() === 666) {
    echo 'You have successfully injected the dependency!';
}
```


```sh
    You have successfully injected the dependency!
```


## License

MIT
