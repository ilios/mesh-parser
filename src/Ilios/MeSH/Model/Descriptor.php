<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use DateTime;

/**
 * Class Descriptor
 * @package Ilios\MeSH\Model
 */
class Descriptor extends Reference
{
    protected string $class;

    protected ?DateTime $dateCreated = null;

    protected ?DateTime $dateEstablished = null;

    protected ?DateTime $dateRevised = null;

    protected ?DateTime $dateIntroduced = null;

    protected ?DateTime $lastUpdated = null;

    protected array $allowableQualifiers = [];

    protected ?string $annotation = null;

    protected ?string $historyNote = null;

    protected ?string $nlmClassificationNumber = null;

    protected ?string $onlineNote = null;

    protected ?string $publicMeshNote = null;

    protected array $previousIndexing = [];

    protected array $entryCombinations = [];

    protected array $relatedDescriptors = [];

    protected ?string $considerAlso = null;

    protected array $pharmacologicalActions = [];

    protected array $treeNumbers = [];

    protected array $concepts = [];

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?DateTime $date): void
    {
        $this->dateCreated = $date;
    }

    public function getDateRevised(): ?DateTime
    {
        return $this->dateRevised;
    }

    public function setDateRevised(?DateTime $date): void
    {
        $this->dateRevised = $date;
    }

    public function getDateIntroduced(): ?DateTime
    {
        return $this->dateIntroduced;
    }

    public function setDateIntroduced(?DateTime $date): void
    {
        $this->dateIntroduced = $date;
    }

    public function getLastUpdated(): ?DateTime
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?DateTime $date): void
    {
        $this->lastUpdated = $date;
    }

    public function getDateEstablished(): ?DateTime
    {
        return $this->dateEstablished;
    }

    public function setDateEstablished(?DateTime $date): void
    {
        $this->dateEstablished = $date;
    }

    public function getAllowableQualifiers(): array
    {
        return $this->allowableQualifiers;
    }

    public function addAllowableQualifier(AllowableQualifier $qualifier): void
    {
        $this->allowableQualifiers[] = $qualifier;
    }

    public function getAnnotation(): ?string
    {
        return $this->annotation;
    }

    public function setAnnotation(?string $annotation): void
    {
        $this->annotation = $annotation;
    }

    public function getHistoryNote(): ?string
    {
        return $this->historyNote;
    }

    public function setHistoryNote(?string $historyNote): void
    {
        $this->historyNote = $historyNote;
    }

    public function getNlmClassificationNumber(): ?string
    {
        return $this->nlmClassificationNumber;
    }

    public function setNlmClassificationNumber(?string $nlmClassificationNumber): void
    {
        $this->nlmClassificationNumber = $nlmClassificationNumber;
    }

    public function getOnlineNote(): ?string
    {
        return $this->onlineNote;
    }

    /**
     * @param string $onlineNote
     */
    public function setOnlineNote(?string $onlineNote): void
    {
        $this->onlineNote = $onlineNote;
    }

    public function getPublicMeshNote(): ?string
    {
        return $this->publicMeshNote;
    }

    public function setPublicMeshNote(?string $publicMeshNote): void
    {
        $this->publicMeshNote = $publicMeshNote;
    }

    public function getPreviousIndexing(): array
    {
        return $this->previousIndexing;
    }

    public function addPreviousIndexing(string $previousIndexing): void
    {
        $this->previousIndexing[] = $previousIndexing;
    }

    public function getEntryCombinations(): array
    {
        return $this->entryCombinations;
    }

    public function addEntryCombination(EntryCombination $entryCombination): void
    {
        $this->entryCombinations[] = $entryCombination;
    }

    public function getRelatedDescriptors(): array
    {
        return $this->relatedDescriptors;
    }

    public function addRelatedDescriptor(Reference $reference): void
    {
        $this->relatedDescriptors[] = $reference;
    }

    public function getConsiderAlso(): ?string
    {
        return $this->considerAlso;
    }

    public function setConsiderAlso(?string $considerAlso): void
    {
        $this->considerAlso = $considerAlso;
    }

    public function getPharmacologicalActions(): array
    {
        return $this->pharmacologicalActions;
    }

    public function addPharmacologicalAction(Reference $reference): void
    {
        $this->pharmacologicalActions[] = $reference;
    }

    public function getTreeNumbers(): array
    {
        return $this->treeNumbers;
    }

    public function addTreeNumber(string $treeNumber): void
    {
        $this->treeNumbers[] = $treeNumber;
    }

    public function getConcepts(): array
    {
        return $this->concepts;
    }

    public function addConcept(Concept $concept): void
    {
        $this->concepts[] = $concept;
    }
}
