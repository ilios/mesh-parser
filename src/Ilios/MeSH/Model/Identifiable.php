<?php

namespace Ilios\MeSH\Model;

/**
 * Trait Identifiable
 * @package Ilios\MeSH\Model
 */
trait Identifiable
{
    /**
     * @var string
     */
    protected $ui;

    /**
     * @return string
     */
    public function getUi()
    {
        return $this->ui;
    }

    /**
     * @param $ui
     */
    public function setUi($ui)
    {
        $this->ui = $ui;
    }
}
