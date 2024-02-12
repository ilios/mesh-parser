<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use DateTime;

/**
 * Class Term
 * @package Ilios\MeSH\Model
 */
class Term extends Reference
{
    protected bool $permuted;
    protected bool $conceptPreferred;
    protected bool $recordPreferred;
    protected string $lexicalTag;
    protected ?string $abbreviation = null;
    protected ?string $sortVersion = null;
    protected ?string $entryVersion = null;
    protected array $thesaurusIds = [];
    protected ?string $note = null ;
    protected ?DateTime $dateCreated = null;

    public function isPermuted(): bool
    {
        return $this->permuted;
    }

    public function setPermuted(bool $permuted): void
    {
        $this->permuted = $permuted;
    }

    public function isConceptPreferred(): bool
    {
        return $this->conceptPreferred;
    }

    public function setConceptPreferred(bool $conceptPreferred): void
    {
        $this->conceptPreferred = $conceptPreferred;
    }

    public function isRecordPreferred(): bool
    {
        return $this->recordPreferred;
    }

    public function setRecordPreferred(bool $recordPreferred): void
    {
        $this->recordPreferred = $recordPreferred;
    }

    public function getLexicalTag(): string
    {
        return $this->lexicalTag;
    }

    public function setLexicalTag(string $lexicalTag): void
    {
        $this->lexicalTag = $lexicalTag;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(?string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }

    public function getSortVersion(): ?string
    {
        return $this->sortVersion;
    }

    public function setSortVersion(?string $sortVersion): void
    {
        $this->sortVersion = $sortVersion;
    }

    public function getEntryVersion(): ?string
    {
        return $this->entryVersion;
    }

    public function setEntryVersion(?string $entryVersion): void
    {
        $this->entryVersion = $entryVersion;
    }

    public function getThesaurusIds(): array
    {
        return $this->thesaurusIds;
    }

    public function addThesaurusId(string $thesaurusId): void
    {
        $this->thesaurusIds[] = $thesaurusId;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    public function getDateCreated(): ?DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }
}
