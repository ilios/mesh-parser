<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class Reference
 * @package Ilios\MeSH\Model
 */
class Reference
{
    use Identifiable;

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
