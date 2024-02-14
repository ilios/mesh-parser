<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class AllowableQualifier
 * @package Ilios\MeSH\Model
 */
class AllowableQualifier
{
    protected Reference $qualifierReference;

    protected string $abbreviation;

    public function getQualifierReference(): Reference
    {
        return $this->qualifierReference;
    }

    public function setQualifierReference(Reference $reference): void
    {
        $this->qualifierReference = $reference;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }
}
