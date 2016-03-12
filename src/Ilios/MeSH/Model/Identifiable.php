<?php

namespace Ilios\MeSH\Model;

/**
 * Class Identifiable
 * @package Ilios\MeSH\Model
 */
trait Identifiable
{
    /**
     * @var string
     */
    protected $ui;

    /**
     * @param $ui
     */
    public function setUi($ui)
    {
        $this->ui = $ui;
    }

    /**
     * @return string
     */
    public function getUi()
    {
        return $this->ui;
    }
}
