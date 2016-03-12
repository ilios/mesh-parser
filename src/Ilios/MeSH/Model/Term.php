<?php

namespace Ilios\MeSH\Model;

/**
 * Class Term
 * @package Ilios\MeSH\Model
 */
class Term extends Reference
{
    /**
     * @var boolean
     */
    protected $permuted;
    /**
     * @var boolean
     */
    protected $conceptPreferred;
    /**
     * @var boolean
     */
    protected $recordPreferred;
    /**
     * @var string
     */
    protected $lexicalTag;

    /**
     * @var string
     */
    protected $abbreviation;

    /**
     * @var string
     */
    protected $sortVersion;

    /**
     * @var string
     */
    protected $entryVersion;

    /**
     * @var string[]
     */
    protected $thesaurusIds = [];

    /**
     * @var string
     */
    protected $note;

    /**
     * @var \DateTime
     */
    protected $dateCreated;

    /**
     * @return boolean
     */
    public function isPermuted()
    {
        return $this->permuted;
    }

    /**
     * @param boolean $permuted
     */
    public function setPermuted($permuted)
    {
        $this->permuted = $permuted;
    }

    /**
     * @return boolean
     */
    public function isConceptPreferred()
    {
        return $this->conceptPreferred;
    }

    /**
     * @param boolean $conceptPreferred
     */
    public function setConceptPreferred($conceptPreferred)
    {
        $this->conceptPreferred = $conceptPreferred;
    }

    /**
     * @return boolean
     */
    public function isRecordPreferred()
    {
        return $this->recordPreferred;
    }

    /**
     * @param boolean $recordPreferred
     */
    public function setRecordPreferred($recordPreferred)
    {
        $this->recordPreferred = $recordPreferred;
    }

    /**
     * @return string
     */
    public function getLexicalTag()
    {
        return $this->lexicalTag;
    }

    /**
     * @param string $lexicalTag
     */
    public function setLexicalTag($lexicalTag)
    {
        $this->lexicalTag = $lexicalTag;
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

    /**
     * @return string
     */
    public function getSortVersion()
    {
        return $this->sortVersion;
    }

    /**
     * @param string $sortVersion
     */
    public function setSortVersion($sortVersion)
    {
        $this->sortVersion = $sortVersion;
    }

    /**
     * @return string
     */
    public function getEntryVersion()
    {
        return $this->entryVersion;
    }

    /**
     * @param string $entryVersion
     */
    public function setEntryVersion($entryVersion)
    {
        $this->entryVersion = $entryVersion;
    }

    /**
     * @return string[]
     */
    public function getThesaurusIds()
    {
        return $this->thesaurusIds;
    }

    /**
     * @param string $thesaurusId
     */
    public function addThesaurusId($thesaurusId)
    {
        $this->thesaurusIds[] = $thesaurusId;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

}
