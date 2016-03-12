<?php

namespace Ilios\MeSH\Model;

/**
 * Class Concept
 * @package Ilios\MeSH\Model
 */
class Concept extends Reference
{
    /**
     * @var boolean
     */
    protected $preferred;

    /**
     * @var string
     */
    protected $casn1Name;

    /**
     * @var string
     */
    protected $registryNumber;
    /**
     * @var string
     */
    protected $scopeNote;

    /**
     * @var string
     */
    protected $translatorsEnglishScopeNote;

    /**
     * @var string
     */
    protected $translatorsScopeNote;

    /**
     * @var string[]
     */
    protected $relatedRegistryNumbers = [];

    /**
     * @var ConceptRelation[]
     */
    protected $conceptRelations = [];

    /**
     * @var Term[]
     */
    protected $terms = [];

    /**
     * @return boolean
     */
    public function isPreferred()
    {
        return $this->preferred;
    }

    /**
     * @param boolean $preferred
     */
    public function setPreferred($preferred)
    {
        $this->preferred = $preferred;
    }

    /**
     * @return string
     */
    public function getCasn1Name()
    {
        return $this->casn1Name;
    }

    /**
     * @param string $casn1Name
     */
    public function setCasn1Name($casn1Name)
    {
        $this->casn1Name = $casn1Name;
    }

    /**
     * @return string
     */
    public function getRegistryNumber()
    {
        return $this->registryNumber;
    }

    /**
     * @param string $registryNumber
     */
    public function setRegistryNumber($registryNumber)
    {
        $this->registryNumber = $registryNumber;
    }

    /**
     * @return string
     */
    public function getScopeNote()
    {
        return $this->scopeNote;
    }

    /**
     * @param string $scopeNote
     */
    public function setScopeNote($scopeNote)
    {
        $this->scopeNote = $scopeNote;
    }

    /**
     * @return string
     */
    public function getTranslatorsEnglishScopeNote()
    {
        return $this->translatorsEnglishScopeNote;
    }

    /**
     * @param string $translatorsEnglishScopeNote
     */
    public function setTranslatorsEnglishScopeNote($translatorsEnglishScopeNote)
    {
        $this->translatorsEnglishScopeNote = $translatorsEnglishScopeNote;
    }

    /**
     * @return string
     */
    public function getTranslatorsScopeNote()
    {
        return $this->translatorsScopeNote;
    }

    /**
     * @param string $translatorsScopeNote
     */
    public function setTranslatorsScopeNote($translatorsScopeNote)
    {
        $this->translatorsScopeNote = $translatorsScopeNote;
    }

    /**
     * @return \string[]
     */
    public function getRelatedRegistryNumbers()
    {
        return $this->relatedRegistryNumbers;
    }

    /**
     * @param string $relatedRegistryNumber
     */
    public function addRelatedRegistryNumber($relatedRegistryNumber)
    {
        $this->relatedRegistryNumbers[] = $relatedRegistryNumber;
    }

    /**
     * @return ConceptRelation[]
     */
    public function getConceptRelations()
    {
        return $this->conceptRelations;
    }

    /**
     * @param ConceptRelation $conceptRelation
     */
    public function addConceptRelation(ConceptRelation $conceptRelation)
    {
        $this->conceptRelations[] = $conceptRelation;
    }

    /**
     * @return Term[]
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param Term $term
     */
    public function addTerm(Term $term)
    {
        $this->terms[] = $term;
    }

}
