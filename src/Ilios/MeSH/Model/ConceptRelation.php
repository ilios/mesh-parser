<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class ConceptRelation
 * @package Ilios\MeSH\Model
 */
class ConceptRelation
{
    protected ?string $name = null;

    protected string $concept1Ui;

    protected string $concept2Ui;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }


    public function getConcept1Ui(): string
    {
        return $this->concept1Ui;
    }

    public function setConcept1Ui(string $concept1Ui): void
    {
        $this->concept1Ui = $concept1Ui;
    }

    public function getConcept2Ui(): string
    {
        return $this->concept2Ui;
    }

    public function setConcept2Ui(string $concept2Ui): void
    {
        $this->concept2Ui = $concept2Ui;
    }
}
