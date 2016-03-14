<?php

namespace Ilios\MeSH\Model;

/**
 * Class Descriptor
 * @package Ilios\MeSH\Model
 */
class Descriptor extends Reference
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var \DateTime
     */
    protected $dateCreated = null;

    /**
     * @var \DateTime|null
     */
    protected $dateEstablished = null;

    /**
     * @var \DateTime|null
     */
    protected $dateRevised = null;

    /**
     * @var AllowableQualifier[]
     */
    protected $allowableQualifiers = [];

    /**
     * @var string
     */
    protected $annotation;

    /**
     * @var string
     */
    protected $historyNote;

    /**
     * @var string
     */
    protected $nlmClassificationNumber;

    /**
     * @var string
     */
    protected $onlineNote;

    /**
     * @var string
     */
    protected $publicMeshNote;

    /**
     * @var string[]
     */
    protected $previousIndexing = [];

    /**
     * @var EntryCombination[]
     */
    protected $entryCombinations = [];

    /**
     * A list of related descriptors references.
     * @var Reference[]
     */
    protected $relatedDescriptors = [];

    /**
     * @var string
     */
    protected $considerAlso;

    /**
     * @var Reference[]
     */
    protected $pharmacologicalActions = [];

    /**
     * @var string[]
     */
    protected $treeNumbers = [];

    /**
     * @var Concept[]
     */
    protected $concepts = [];

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $date
     */
    public function setDateCreated(\DateTime $date)
    {
        $this->dateCreated = $date;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRevised()
    {
        return $this->dateRevised;
    }

    /**
     * @param \DateTime $date
     */
    public function setDateRevised(\DateTime $date)
    {
        $this->dateRevised = $date;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateEstablished()
    {
        return $this->dateEstablished;
    }

    /**
     * @param \DateTime $date |null
     */
    public function setDateEstablished(\DateTime $date)
    {
        $this->dateEstablished = $date;
    }

    /**
     * @return AllowableQualifier[]
     */
    public function getAllowableQualifiers()
    {
        return $this->allowableQualifiers;
    }

    /**
     * @param AllowableQualifier $qualifier
     */
    public function addAllowableQualifier(AllowableQualifier $qualifier)
    {
        $this->allowableQualifiers[] = $qualifier;
    }

    /**
     * @return string
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * @param string $annotation
     */
    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;
    }

    /**
     * @return string
     */
    public function getHistoryNote()
    {
        return $this->historyNote;
    }

    /**
     * @param string $historyNote
     */
    public function setHistoryNote($historyNote)
    {
        $this->historyNote = $historyNote;
    }

    /**
     * @return string
     */
    public function getNlmClassificationNumber()
    {
        return $this->nlmClassificationNumber;
    }

    /**
     * @param string $nlmClassificationNumber
     */
    public function setNlmClassificationNumber($nlmClassificationNumber)
    {
        $this->nlmClassificationNumber = $nlmClassificationNumber;
    }

    /**
     * @return string
     */
    public function getOnlineNote()
    {
        return $this->onlineNote;
    }

    /**
     * @param string $onlineNote
     */
    public function setOnlineNote($onlineNote)
    {
        $this->onlineNote = $onlineNote;
    }

    /**
     * @return string
     */
    public function getPublicMeshNote()
    {
        return $this->publicMeshNote;
    }

    /**
     * @param string $publicMeshNote
     */
    public function setPublicMeshNote($publicMeshNote)
    {
        $this->publicMeshNote = $publicMeshNote;
    }

    /**
     * @return string[]
     */
    public function getPreviousIndexing()
    {
        return $this->previousIndexing;
    }

    /**
     * @param string $previousIndexing
     */
    public function addPreviousIndexing($previousIndexing)
    {
        $this->previousIndexing[] = $previousIndexing;
    }

    /**
     * @return EntryCombination[]
     */
    public function getEntryCombinations()
    {
        return $this->entryCombinations;
    }

    /**
     * @param EntryCombination $entryCombination
     */
    public function addEntryCombination($entryCombination)
    {
        $this->entryCombinations[] = $entryCombination;
    }

    /**
     * @return Reference[]
     */
    public function getRelatedDescriptors()
    {
        return $this->relatedDescriptors;
    }

    /**
     * @param Reference $reference
     */
    public function addRelatedDescriptor(Reference $reference)
    {
        $this->relatedDescriptors[] = $reference;
    }

    /**
     * @return string
     */
    public function getConsiderAlso()
    {
        return $this->considerAlso;
    }

    /**
     * @param string $considerAlso
     */
    public function setConsiderAlso($considerAlso)
    {
        $this->considerAlso = $considerAlso;
    }

    /**
     * @return Reference[]
     */
    public function getPharmacologicalActions()
    {
        return $this->pharmacologicalActions;
    }

    /**
     * @param Reference $reference
     */
    public function addPharmacologicalAction($reference)
    {
        $this->pharmacologicalActions[] = $reference;
    }

    /**
     * @return string[]
     */
    public function getTreeNumbers()
    {
        return $this->treeNumbers;
    }

    /**
     * @param string $treeNumber
     */
    public function addTreeNumber($treeNumber)
    {
        $this->treeNumbers[] = $treeNumber;
    }

    /**
     * @return Concept[]
     */
    public function getConcepts()
    {
        return $this->concepts;
    }

    /**
     * @param Concept $concept
     */
    public function addConcept(Concept $concept)
    {
        $this->concepts[] = $concept;
    }
}
