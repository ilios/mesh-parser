<?php

namespace Ilios\MeSH\Model;

/**
 * Class DescriptorSet
 * @package Ilios\MeSH\Model
 */
class DescriptorSet
{
    /**
     * @var Descriptor[]
     */
    protected $descriptors = [];

    /**
     * @var string
     */
    protected $languageCode;

    /**
     * @param string $code
     */
    public function setLanguageCode($code)
    {
        $this->languageCode = $code;
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param \Ilios\MeSH\Model\Descriptor $descriptor
     */
    public function addDescriptor(Descriptor $descriptor)
    {
        // @todo check for empty keys and duplicates here. maybe. [ST 2015/03/15]
        $this->descriptors[$descriptor->getUi()] = $descriptor;
    }

    /**
     * Retrieves all descriptors in this set.
     * @return Descriptor[]
     */
    public function getDescriptors()
    {
        return array_values($this->descriptors);
    }

    /**
     * Returns the identifiers of all descriptors in this set.
     * @return array
     */
    public function getDescriptorUis()
    {
        return array_keys($this->descriptors);
    }

    /**
     * Finds and returns a descriptor in this set by its unique identifier ('UI').
     * @param string $ui The descriptor's identifier.
     * @return bool|Descriptor the descriptor if found, otherwise FALSE.
     */
    public function findDescriptorByUi($ui)
    {
        if (array_key_exists($ui, $this->descriptors)) {
            return $this->descriptors[$ui];
        }
        return false;
    }
}
