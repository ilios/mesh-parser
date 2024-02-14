<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Trait Identifiable
 * @package Ilios\MeSH\Model
 */
trait Identifiable
{
    protected string $ui;

    public function getUi(): string
    {
        return $this->ui;
    }

    public function setUi(string $ui): void
    {
        $this->ui = $ui;
    }
}
