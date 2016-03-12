<?php

namespace Ilios\MeSH\Model;

/**
 * Class EntryCombination
 * @package Ilios\MeSH\Model
 */
class EntryCombination
{
    /**
     * Inbound descriptor reference.
     * @var Reference
     */
    protected $descriptorIn;

    /**
     * Outbound descriptor reference.
     * @var Reference
     */
    protected $descriptorOut;

    /**
     * Inbound qualifier reference.
     * @var Reference
     */
    protected $qualifierIn;

    /**
     * Outbound qualifier reference.
     * @var Reference
     */
    protected $qualifierOut;

    /**
     * @return Reference
     */
    public function getDescriptorIn()
    {
        return $this->descriptorIn;
    }

    /**
     * @param Reference $descriptorIn
     */
    public function setDescriptorIn(Reference $descriptorIn)
    {
        $this->descriptorIn = $descriptorIn;
    }

    /**
     * @return Reference
     */
    public function getDescriptorOut()
    {
        return $this->descriptorOut;
    }

    /**
     * @param Reference $descriptorOut
     */
    public function setDescriptorOut(Reference $descriptorOut)
    {
        $this->descriptorOut = $descriptorOut;
    }

    /**
     * @return Reference
     */
    public function getQualifierIn()
    {
        return $this->qualifierIn;
    }

    /**
     * @param Reference $qualifierIn
     */
    public function setQualifierIn(Reference $qualifierIn)
    {
        $this->qualifierIn = $qualifierIn;
    }

    /**
     * @return string
     */
    public function getQualifierOut()
    {
        return $this->qualifierOut;
    }

    /**
     * @param Reference $qualifierOut
     */
    public function setQualifierOut(Reference $qualifierOut)
    {
        $this->qualifierOut = $qualifierOut;
    }

}
