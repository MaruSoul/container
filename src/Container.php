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
    protected array $entities = [];

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

        return $this->entities[$id]->get();
    }

    public function has(string $id): bool
    {
        return isset($this->entities[$id]);
    }

    public function add(string $id, mixed $value): IEntityInterface
    {
        $this->entities[$id] = new $this->entityClassName($value);

        return $this->entities[$id];
    }

    public function getByTag(string $tag): array
    {
        $result = [];

        foreach ($this->entities as $id => $entity) {
            if (in_array($tag, $entity->getTags())) {
                $result[$id] = $entity->get();
            }
        }

        return $result;
    }
}
