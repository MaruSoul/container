<?php

namespace Container;

use Container\Interfaces\EntityInterface;

class Entity implements EntityInterface
{
    /**
    * @var string[]
    */
    protected array $tags = [];

    /**
     * @param mixed $entity
     */
    public function __construct(protected mixed $entity)
    {
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $tag
     * @return EntityInterface
     */
    public function addTag(string $tag): EntityInterface
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get(): mixed
    {
        if (is_callable($this->entity)) {
            return ($this->entity)();
        }

        return $this->entity;
    }
}
