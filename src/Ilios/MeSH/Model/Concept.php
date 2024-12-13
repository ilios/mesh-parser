<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class Concept
 * @package Ilios\MeSH\Model
 */
class Concept extends Reference
{
    protected bool $preferred;

    protected ?string $casn1Name = null;

    protected ?string $scopeNote = null;

    protected ?string $translatorsEnglishScopeNote = null;

    protected ?string $translatorsScopeNote = null;

    protected array $relatedRegistryNumbers = [];

    protected array $conceptRelations = [];

    protected array $terms = [];

    protected array $registryNumbers = [];

    public function isPreferred(): bool
    {
        return $this->preferred;
    }

    public function setPreferred(bool $preferred): void
    {
        $this->preferred = $preferred;
    }

    public function getCasn1Name(): ?string
    {
        return $this->casn1Name;
    }

    public function setCasn1Name(?string $casn1Name): void
    {
        $this->casn1Name = $casn1Name;
    }

    public function getScopeNote(): ?string
    {
        return $this->scopeNote;
    }

    public function setScopeNote(?string $scopeNote): void
    {
        $this->scopeNote = $scopeNote;
    }

    public function getTranslatorsEnglishScopeNote(): ?string
    {
        return $this->translatorsEnglishScopeNote;
    }

    public function setTranslatorsEnglishScopeNote(?string $translatorsEnglishScopeNote): void
    {
        $this->translatorsEnglishScopeNote = $translatorsEnglishScopeNote;
    }

    public function getTranslatorsScopeNote(): ?string
    {
        return $this->translatorsScopeNote;
    }

    public function setTranslatorsScopeNote(?string $translatorsScopeNote): void
    {
        $this->translatorsScopeNote = $translatorsScopeNote;
    }

    public function getRelatedRegistryNumbers(): array
    {
        return $this->relatedRegistryNumbers;
    }

    public function addRelatedRegistryNumber(string $relatedRegistryNumber): void
    {
        $this->relatedRegistryNumbers[] = $relatedRegistryNumber;
    }

    public function getConceptRelations(): array
    {
        return $this->conceptRelations;
    }

    public function addConceptRelation(ConceptRelation $conceptRelation): void
    {
        $this->conceptRelations[] = $conceptRelation;
    }

    public function getTerms(): array
    {
        return $this->terms;
    }

    public function addTerm(Term $term): void
    {
        $this->terms[] = $term;
    }

    public function getRegistryNumbers(): array
    {
        return $this->registryNumbers;
    }

    public function addRegistryNumber(string $registryNumber): void
    {
        $this->registryNumbers[] = $registryNumber;
    }
}
