<?php

namespace Ilios\MeSH\Model;

/**
 * Class ConceptRelation
 * @package Ilios\MeSH\Model
 */
class ConceptRelation
{
    use Nameable;

    /**
     * Concept identifier.
     * @var string
     */
    protected $concept1Ui;

    /**
     * Concept identifier.
     * @var string
     */
    protected $concept2Ui;

    /**
     * @return string
     */
    public function getConcept1Ui()
    {
        return $this->concept1Ui;
    }

    /**
     * @param string $concept1Ui
     */
    public function setConcept1Ui($concept1Ui)
    {
        $this->concept1Ui = $concept1Ui;
    }

    /**
     * @return string
     */
    public function getConcept2Ui()
    {
        return $this->concept2Ui;
    }

    /**
     * @param string $concept2Ui
     */
    public function setConcept2Ui($concept2Ui)
    {
        $this->concept2Ui = $concept2Ui;
    }
}

