<?php

namespace Ilios\MeSH\Model;

/**
 * Class AllowableQualifierTest
 * @package Ilios\MeSH\Model
 */
class AllowableQualifierTest extends BaseTest
{
    /**
     * @var AllowableQualifier
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->object = new AllowableQualifier();
    }

    /**
     * @inheritdoc
     */
    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
    }

    /**
     * @covers \Ilios\MeSH\Model\AllowableQualifier::getQualifierReference
     * @covers \Ilios\MeSH\Model\AllowableQualifier::setQualifierReference
     */
    public function testGetSetQualifierReference()
    {
        $this->modelSetTest($this->object, 'qualifierReference', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\AllowableQualifier::getAbbreviation
     * @covers \Ilios\MeSH\Model\AllowableQualifier::setAbbreviation
     */
    public function testGetSetAbbreviation()
    {
        $this->basicSetTest($this->object, 'abbreviation', 'string');
    }
}
