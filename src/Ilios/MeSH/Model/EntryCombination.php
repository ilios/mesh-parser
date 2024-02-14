<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

/**
 * Class EntryCombination
 * @package Ilios\MeSH\Model
 */
class EntryCombination
{
    /**
     * Inbound descriptor reference.
     */
    protected Reference $descriptorIn;

    /**
     * Outbound descriptor reference.
     */
    protected Reference $descriptorOut;

    /**
     * Inbound qualifier reference.
     */
    protected Reference $qualifierIn;

    /**
     * Outbound qualifier reference.
     */
    protected ?Reference $qualifierOut = null;

    public function getDescriptorIn(): Reference
    {
        return $this->descriptorIn;
    }

    public function setDescriptorIn(Reference $descriptorIn): void
    {
        $this->descriptorIn = $descriptorIn;
    }

    public function getDescriptorOut(): Reference
    {
        return $this->descriptorOut;
    }

    public function setDescriptorOut(Reference $descriptorOut): void
    {
        $this->descriptorOut = $descriptorOut;
    }

    public function getQualifierIn(): Reference
    {
        return $this->qualifierIn;
    }

    public function setQualifierIn(Reference $qualifierIn): void
    {
        $this->qualifierIn = $qualifierIn;
    }

    public function getQualifierOut(): ?Reference
    {
        return $this->qualifierOut;
    }

    public function setQualifierOut(?Reference $qualifierOut): void
    {
        $this->qualifierOut = $qualifierOut;
    }
}
