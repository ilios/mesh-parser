<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class TermTest
 *
 * @package Ilios\MeSH\Model
 * #[CoversClass(Term::class)]
 */
class TermTest extends BaseTestCase
{
    protected Term $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Term();
    }

    public function testConstructor(): void
    {
        $this->assertEmpty($this->object->getThesaurusIds());
    }

    public function testIsSetPermuted(): void
    {
        $this->booleanSetTest($this->object, 'permuted');
    }

    public function testIsSetConceptPreferred(): void
    {
        $this->booleanSetTest($this->object, 'conceptPreferred');
    }

    public function testIsSetRecordPreferred(): void
    {
        $this->booleanSetTest($this->object, 'recordPreferred');
    }

    public function testGetSetLexicalTag(): void
    {
        $this->basicSetTest($this->object, 'lexicalTag', 'string');
    }

    public function testGetSetAbbreviation(): void
    {
        $this->basicSetTest($this->object, 'abbreviation', 'string');
    }

    public function testGetSetSortVersion(): void
    {
        $this->basicSetTest($this->object, 'sortVersion', 'string');
    }

    public function testGetSetEntryVersion(): void
    {
        $this->basicSetTest($this->object, 'entryVersion', 'string');
    }

    public function testAddGetThesaurusIds(): void
    {
        $this->addTextToListTest($this->object, 'thesaurusId');
    }

    public function testGetSetNote(): void
    {
        $this->basicSetTest($this->object, 'note', 'string');
    }

    public function testGetDateCreated(): void
    {
        $this->basicSetTest($this->object, 'dateCreated', 'datetime');
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
