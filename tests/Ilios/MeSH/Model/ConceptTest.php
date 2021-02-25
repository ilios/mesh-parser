<?php

namespace Ilios\MeSH\Model;

/**
 * Class ConceptTest
 * @package Ilios\MeSH\Model
 */
class ConceptTest extends ReferenceTest
{
    /**
     * @var Concept
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Concept();
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
     * @covers \Ilios\MeSH\Model\Concept::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->object->getRelatedRegistryNumbers());
        $this->assertEmpty($this->object->getTerms());
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::isPreferred
     * @covers \Ilios\MeSH\Model\Concept::setPreferred
     */
    public function testIsSetPreferred()
    {
        $this->booleanSetTest($this->object, 'preferred', true);
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::getCasn1Name
     * @covers \Ilios\MeSH\Model\Concept::setCasn1Name
     */
    public function testGetSetCasn1Name()
    {
        $this->basicSetTest($this->object, 'casn1Name', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::getRegistryNumber
     * @covers \Ilios\MeSH\Model\Concept::setRegistryNumber
     */
    public function testGetSetRegistryNumber()
    {
        $this->basicSetTest($this->object, 'registryNumber', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::getScopeNote
     * @covers \Ilios\MeSH\Model\Concept::setScopeNote
     */
    public function testGetSetScopeNote()
    {
        $this->basicSetTest($this->object, 'scopeNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::getTranslatorsEnglishScopeNote
     * @covers \Ilios\MeSH\Model\Concept::setTranslatorsEnglishScopeNote
     */
    public function testGetSetTranslatorsEnglishScopeNote()
    {
        $this->basicSetTest($this->object, 'translatorsEnglishScopeNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::getTranslatorsScopeNote
     * @covers \Ilios\MeSH\Model\Concept::setTranslatorsScopeNote
     */
    public function testGetSetTranslatorsScopeNote()
    {
        $this->basicSetTest($this->object, 'translatorsScopeNote', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::addRelatedRegistryNumber
     * @covers \Ilios\MeSH\Model\Concept::getRelatedRegistryNumbers
     */
    public function testAddGetRelatedRegistryNumbers()
    {
        $this->addTextToListTest($this->object, 'relatedRegistryNumber');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::addConceptRelation
     * @covers \Ilios\MeSH\Model\Concept::getConceptRelations
     */
    public function testAddGetConceptRelations()
    {
        $this->addModelToListTest($this->object, 'conceptRelation', 'ConceptRelation');
    }

    /**
     * @covers \Ilios\MeSH\Model\Concept::addTerm
     * @covers \Ilios\MeSH\Model\Concept::getTerms
     */
    public function testAddGetTerms()
    {
        $this->addModelToListTest($this->object, 'term', 'Term');
    }
}
