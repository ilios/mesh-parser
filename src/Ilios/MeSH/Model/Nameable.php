<?php

namespace Ilios\MeSH\Model;

/**
 * Class Nameable
 * @package Ilios\MeSH\Model
 */
trait Nameable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
