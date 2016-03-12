<?php

namespace Ilios\MeSH\Model;

/**
 * Class AllowableQualifier
 * @package Ilios\MeSH\Model
 */
class AllowableQualifier
{
    /**
     * @var Reference
     */
    protected $qualifierReference;

    /**
     * @var string
     */
    protected $abbreviation;

    /**
     * @return Reference
     */
    public function getQualifierReference()
    {
        return $this->qualifierReference;
    }

    /**
     * @param Reference $reference
     */
    public function setQualifierReference(Reference $reference)
    {
        $this->qualifierReference = $reference;
    }

    /**
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;
    }
}
