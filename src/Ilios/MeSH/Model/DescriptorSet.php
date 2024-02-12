<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class DescriptorSet
 * @package Ilios\MeSH\Model
 */
class DescriptorSet
{
    protected array $descriptors = [];
    protected ?string $languageCode = null;


    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(?string $code): void
    {
        $this->languageCode = $code;
    }

    public function addDescriptor(Descriptor $descriptor): void
    {
        // @todo check for empty keys and duplicates here. maybe. [ST 2015/03/15]
        $this->descriptors[$descriptor->getUi()] = $descriptor;
    }

    /**
     * Retrieves all descriptors in this set.
     */
    public function getDescriptors(): array
    {
        return array_values($this->descriptors);
    }

    /**
     * Returns the identifiers of all descriptors in this set.
     */
    public function getDescriptorUis(): array
    {
        return array_keys($this->descriptors);
    }

    /**
     * Finds and returns a descriptor in this set by its unique identifier ('UI').
     * @param string $ui The descriptor's identifier.
     * @return bool|Descriptor the descriptor if found, otherwise FALSE.
     */
    public function findDescriptorByUi(string $ui): bool|Descriptor
    {
        if (array_key_exists($ui, $this->descriptors)) {
            return $this->descriptors[$ui];
        }

        return false;
    }
}
