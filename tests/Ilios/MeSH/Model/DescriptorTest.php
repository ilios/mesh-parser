<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class DescriptorTest
 *
 * @package Ilios\MeSH\Model
 */
#[CoversClass(Descriptor::class)]
class DescriptorTest extends BaseTestCase
{
    protected Descriptor $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Descriptor();
    }

    public function testConstructor(): void
    {
        $this->assertEmpty($this->object->getConcepts());
        $this->assertEmpty($this->object->getEntryCombinations());
        $this->assertEmpty($this->object->getAllowableQualifiers());
    }

    public function testGetSetClass(): void
    {
        $this->basicSetTest($this->object, 'class', 'string');
    }

    public function testGetSetDateCreated(): void
    {
        $this->basicSetTest($this->object, 'dateCreated', 'datetime');
    }

    public function testGetSetDateRevised(): void
    {
        $this->basicSetTest($this->object, 'dateRevised', 'datetime');
    }

    public function testGetSetDateEstablished(): void
    {
        $this->basicSetTest($this->object, 'dateEstablished', 'datetime');
    }

    public function testAddGetAllowableQualifiers(): void
    {
        $this->addModelToListTest($this->object, 'allowableQualifier', 'AllowableQualifier');
    }

    public function testGetSetAnnotation(): void
    {
        $this->basicSetTest($this->object, 'annotation', 'string');
    }

    public function testGetSetHistoryNote(): void
    {
        $this->basicSetTest($this->object, 'historyNote', 'string');
    }

    public function testNlmClassificationNumber(): void
    {
        $this->basicSetTest($this->object, 'nlmClassificationNumber', 'string');
    }

    public function testGetSetOnlineNote(): void
    {
        $this->basicSetTest($this->object, 'onlineNote', 'string');
    }

    public function testGetSetPublicMeshNote(): void
    {
        $this->basicSetTest($this->object, 'publicMeshNote', 'string');
    }

    public function testAddGetPreviousIndexing(): void
    {
        $this->addTextToListTest($this->object, 'previousIndexing', 'getPreviousIndexing');
    }

    public function testAddGetEntryCombinations(): void
    {
        $this->addModelToListTest($this->object, 'entryCombination', 'EntryCombination');
    }

    public function testAddGetRelatedDescriptors(): void
    {
        $this->addModelToListTest($this->object, 'relatedDescriptor', 'Reference');
    }

    public function testGetSetConsiderAlso(): void
    {
        $this->basicSetTest($this->object, 'considerAlso', 'string');
    }

    public function testAddGetPharmacologicalAction(): void
    {
        $this->addModelToListTest($this->object, 'pharmacologicalAction', 'Reference');
    }

    public function testAddGetTreeNumbers(): void
    {
        $this->addTextToListTest($this->object, 'treeNumber');
    }

    public function testAddGetConcepts(): void
    {
        $this->addModelToListTest($this->object, 'concept', 'Concept');
    }

    public function testGetSetUi(): void
    {
        $this->basicSetTest($this->object, 'ui', 'string');
    }

    public function testGetSetName(): void
    {
        $this->basicSetTest($this->object, 'name', 'string');
    }
}
