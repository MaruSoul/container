<?php

namespace Container;

use Container\Exceptions\{NotImplementRequiredInterfaceException, ServiceNotFoundException};
use Container\Interfaces\{IContainerInterface, IEntityInterface};
use Psr\Container\ContainerInterface;

class Container implements IContainerInterface, ContainerInterface
{
    /**
     * @var IEntityInterface[]
     */
    protected array $services = [];

    /**
     * @throws NotImplementRequiredInterfaceException
     */
    public function __construct(
        protected string $entityClassName = Entity::class
    )
    {
        if (!is_subclass_of($this->entityClassName, IEntityInterface::class)) {
            throw new NotImplementRequiredInterfaceException(IEntityInterface::class);
        }
    }

    /**
     * @throws ServiceNotFoundException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException($id);
        }

        return $this->services[$id]->get();
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    public function add(string $id, mixed $value): IEntityInterface
    {
        $this->services[$id] = new $this->entityClassName($value);

        return $this->services[$id];
    }
}
