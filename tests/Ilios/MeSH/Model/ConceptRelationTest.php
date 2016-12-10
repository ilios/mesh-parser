<?php

namespace Ilios\MeSH\Model;

/**
 * Class ConceptRelationTest
 * @package Ilios\MeSH\Model
 */
class ConceptRelationTest extends BaseTest
{
    /**
     * @var ConceptRelation
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new ConceptRelation();
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->object);
    }

    /**
     * @covers \Ilios\MeSH\Model\ConceptRelation::getName
     * @covers \Ilios\MeSH\Model\ConceptRelation::setName
     */
    public function testGetSetName()
    {
        $this->basicSetTest($this->object, 'name', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\ConceptRelation::getConcept1Ui
     * @covers \Ilios\MeSH\Model\ConceptRelation::setConcept1Ui
     */
    public function testGetSetConcept1Ui()
    {
        $this->basicSetTest($this->object, 'concept1Ui', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\ConceptRelation::getConcept2Ui
     * @covers \Ilios\MeSH\Model\ConceptRelation::setConcept2Ui
     */
    public function testGetSetConcept2Ui()
    {
        $this->basicSetTest($this->object, 'concept2Ui', 'string');
    }
}
