<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Trait Nameable
 * @package Ilios\MeSH\Model
 */
trait Nameable
{
    protected string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
