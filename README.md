# Container
This project is example my work for portfolio. Container is dependency injection container. It allows you to implement the dependency injection design pattern meaning that you can decouple your class dependencies and have the container inject them where they are needed.

## Global usage

Your code:

```php
<?php

class Сooker implements IСookerInterface
{
    // some code
}

class Fridge implements IFridgeInterface
{
    // some code
}

class Kitchen
{
    public function __construct(
        protected IСookerInterface $cooker,
        protected IFridgeInterface $fridge,
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

$container->add(IСookerInterface::class, 
        fn() => new Сooker()
    )->addTag('apartment');

$container->add(IFridgeInterface::class, 
        fn() => new Fridge()
    )->addTag('apartment');

$container->add(Kitchen::class, 
        fn() => new Kitchen(
            $container->get(IСookerInterface::class),
            $container->get(IFridgeInterface::class),
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
