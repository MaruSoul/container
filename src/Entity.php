<?php

namespace Container;

use Container\Interfaces\IEntityInterface;

class Entity implements IEntityInterface
{
    /**
    * @var string[]
    */
    protected array $tags = [];
    
    public function __construct(protected mixed $entity)
    {
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function addTag(string $tag): IEntityInterface
    {
        $this->tags[] = $tag;
        return $this;
    }

    public function get(): mixed
    {
        if (is_callable($this->entity)) {
            return ($this->entity)();
        }

        return $this->entity;
    }
}