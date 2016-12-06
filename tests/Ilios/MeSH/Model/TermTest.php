<?php

namespace Ilios\MeSH\Model;

/**
 * Class TermTest
 * @package Ilios\MeSH\Model
 */
class TermTest extends ReferenceTest
{
    /**
     * @var Term
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new Term();
    }

    /**
     * @covers Ilios\MeSH\Model\Term::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->object->getThesaurusIds());
    }

    /**
     * @covers Ilios\MeSH\Model\Term::isPermuted
     * @covers Ilios\MeSH\Model\Term::setPermuted
     */
    public function testIsSetPermuted()
    {
        $this->booleanSetTest($this->object, 'permuted', true);
    }

    /**
     * @covers Ilios\MeSH\Model\Term::isConceptPreferred
     * @covers Ilios\MeSH\Model\Term::setConceptPreferred
     */
    public function testIsSetConceptPreferred()
    {
        $this->booleanSetTest($this->object, 'conceptPreferred', true);
    }

    /**
     * @covers Ilios\MeSH\Model\Term::isRecordPreferred
     * @covers Ilios\MeSH\Model\Term::setRecordPreferred
     */
    public function testIsSetRecordPreferred()
    {
        $this->booleanSetTest($this->object, 'recordPreferred', true);
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getLexicalTag
     * @covers Ilios\MeSH\Model\Term::setLexicalTag
     */
    public function testGetSetLexicalTag()
    {
        $this->basicSetTest($this->object, 'lexicalTag', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getAbbreviation
     * @covers Ilios\MeSH\Model\Term::setAbbreviation
     */
    public function testGetSetAbbreviation()
    {
        $this->basicSetTest($this->object, 'abbreviation', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getSortVersion
     * @covers Ilios\MeSH\Model\Term::setSortVersion
     */
    public function testGetSetSortVersion()
    {
        $this->basicSetTest($this->object, 'sortVersion', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getEntryVersion
     * @covers Ilios\MeSH\Model\Term::setEntryVersion
     */
    public function testGetSetEntryVersion()
    {
        $this->basicSetTest($this->object, 'entryVersion', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::addThesaurusId
     * @covers Ilios\MeSH\Model\Term::getThesaurusIds
     */
    public function testAddGetThesaurusIds()
    {
        $this->addTextToListTest($this->object, 'thesaurusId');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getNote
     * @covers Ilios\MeSH\Model\Term::setNote
     */
    public function testGetSetNote()
    {
        $this->basicSetTest($this->object, 'note', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Term::getDateCreated
     * @covers Ilios\MeSH\Model\Term::setDateCreated
     */
    public function testGetDateCreated()
    {
        $this->basicSetTest($this->object, 'dateCreated', 'datetime');
    }
}
