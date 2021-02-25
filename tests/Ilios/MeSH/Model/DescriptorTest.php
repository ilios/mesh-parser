<?php

namespace Ilios\MeSH\Model;

/**
 * Class DescriptorTest
 * @package Ilios\MeSH\Model
 */
class DescriptorTest extends ReferenceTest
{
    /**
     * @var Descriptor
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Descriptor();
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->object->getConcepts());
        $this->assertEmpty($this->object->getEntryCombinations());
        $this->assertEmpty($this->object->getAllowableQualifiers());
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setClass
     * @covers \Ilios\MeSH\Model\Descriptor::getClass
     */
    public function testGetSetClass()
    {
        $this->basicSetTest($this->object, 'class', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setDateCreated
     * @covers \Ilios\MeSH\Model\Descriptor::getDateCreated
     */
    public function testGetSetDateCreated()
    {
        $this->basicSetTest($this->object, 'dateCreated', 'datetime');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setDateRevised
     * @covers \Ilios\MeSH\Model\Descriptor::getDateRevised
     */
    public function testGetSetDateRevised()
    {
        $this->basicSetTest($this->object, 'dateRevised', 'datetime');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setDateEstablished
     * @covers \Ilios\MeSH\Model\Descriptor::getDateEstablished
     */
    public function testGetSetDateEstablished()
    {
        $this->basicSetTest($this->object, 'dateEstablished', 'datetime');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addAllowableQualifier
     * @covers \Ilios\MeSH\Model\Descriptor::getAllowableQualifiers
     */
    public function testAddGetAllowableQualifiers()
    {
        $this->addModelToListTest($this->object, 'allowableQualifier', 'AllowableQualifier');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setAnnotation
     * @covers \Ilios\MeSH\Model\Descriptor::getAnnotation
     */
    public function testGetSetAnnotation()
    {
        $this->basicSetTest($this->object, 'annotation', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setHistoryNote
     * @covers \Ilios\MeSH\Model\Descriptor::getHistoryNote
     */
    public function testGetSetHistoryNote()
    {
        $this->basicSetTest($this->object, 'historyNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setNlmClassificationNumber
     * @covers \Ilios\MeSH\Model\Descriptor::getNlmClassificationNumber
     */
    public function testNlmClassificationNumber()
    {
        $this->basicSetTest($this->object, 'nlmClassificationNumber', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setOnlineNote
     * @covers \Ilios\MeSH\Model\Descriptor::getOnlineNote
     */
    public function testGetSetOnlineNote()
    {
        $this->basicSetTest($this->object, 'onlineNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setPublicMeshNote
     * @covers \Ilios\MeSH\Model\Descriptor::getPublicMeshNote
     */
    public function testGetSetPublicMeshNote()
    {
        $this->basicSetTest($this->object, 'publicMeshNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addPreviousIndexing
     * @covers \Ilios\MeSH\Model\Descriptor::getPreviousIndexing
     */
    public function testAddGetPreviousIndexing()
    {
        $this->addTextToListTest($this->object, 'previousIndexing', 'getPreviousIndexing');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addEntryCombination
     * @covers \Ilios\MeSH\Model\Descriptor::getEntryCombinations
     */
    public function testAddGetEntryCombinations()
    {
        $this->addModelToListTest($this->object, 'entryCombination', 'EntryCombination');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addRelatedDescriptor
     * @covers \Ilios\MeSH\Model\Descriptor::getRelatedDescriptors
     */
    public function testAddGetRelatedDescriptors()
    {
        $this->addModelToListTest($this->object, 'relatedDescriptor', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::setConsiderAlso
     * @covers \Ilios\MeSH\Model\Descriptor::getConsiderAlso
     */
    public function testGetSetConsiderAlso()
    {
        $this->basicSetTest($this->object, 'considerAlso', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addPharmacologicalAction
     * @covers \Ilios\MeSH\Model\Descriptor::getPharmacologicalActions
     */
    public function testAddGetPharmacologicalAction()
    {
        $this->addModelToListTest($this->object, 'pharmacologicalAction', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addTreeNumber
     * @covers \Ilios\MeSH\Model\Descriptor::getTreeNumbers
     */
    public function testAddGetTreeNumbers()
    {
        $this->addTextToListTest($this->object, 'treeNumber');
    }

    /**
     * @covers \Ilios\MeSH\Model\Descriptor::addConcept
     * @covers \Ilios\MeSH\Model\Descriptor::getConcepts
     */
    public function testAddGetConcepts()
    {
        $this->addModelToListTest($this->object, 'concept', 'Concept');
    }
}
