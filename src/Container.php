<?php

namespace Container;

use Container\Exceptions\{NotImplementRequiredInterfaceException, EntityNotFoundException};
use Container\Interfaces\{ContainerInterface, EntityInterface};
use Psr\Container\ContainerInterface as PsrContainerInterface;

class Container implements ContainerInterface, PsrContainerInterface
{
    /**
     * @var EntityInterface[]
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
        if (!is_subclass_of($this->entityClassName, EntityInterface::class)) {
            throw new NotImplementRequiredInterfaceException(EntityInterface::class);
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
     * @return EntityInterface
     */
    public function add(string $id, mixed $value): EntityInterface
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
