<?php

namespace Container;

use Container\Exceptions\{NotImplementRequiredInterfaceException, EntityNotFoundException};
use Container\Interfaces\{IContainerInterface, IEntityInterface};
use Psr\Container\ContainerInterface;

class Container implements IContainerInterface, ContainerInterface
{
    /**
     * @var IEntityInterface[]
     */
    protected array $entities = [];

    /**
     * @param string $entityClassName
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
     * @param string $id
     * @return mixed
     * @throws EntityNotFoundException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new EntityNotFoundException($id);
        }

        return $this->entities[$id]->get();
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->entities[$id]);
    }

    /**
     * @param string $id
     * @param mixed $value
     * @return IEntityInterface
     */
    public function add(string $id, mixed $value): IEntityInterface
    {
        $this->entities[$id] = new $this->entityClassName($value);

        return $this->entities[$id];
    }

    /**
     * @param string $tag
     * @return array
     */
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
