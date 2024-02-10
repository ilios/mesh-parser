<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class ConceptTest
 *
 * @package Ilios\MeSH\Model
 * #[CoversClass(Concept::class)]
 */
class ConceptTest extends BaseTestCase
{
    protected Concept $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Concept();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
    }

    public function testConstructor(): void
    {
        $this->assertEmpty($this->object->getRelatedRegistryNumbers());
        $this->assertEmpty($this->object->getTerms());
    }

    public function testIsSetPreferred(): void
    {
        $this->booleanSetTest($this->object, 'preferred', true);
    }

    public function testGetSetCasn1Name(): void
    {
        $this->basicSetTest($this->object, 'casn1Name', 'string');
    }

    public function testGetSetRegistryNumber(): void
    {
        $this->basicSetTest($this->object, 'registryNumber', 'string');
    }

    public function testGetSetScopeNote(): void
    {
        $this->basicSetTest($this->object, 'scopeNote', 'string');
    }

    public function testGetSetTranslatorsEnglishScopeNote(): void
    {
        $this->basicSetTest($this->object, 'translatorsEnglishScopeNote', 'string');
    }

    public function testGetSetTranslatorsScopeNote(): void
    {
        $this->basicSetTest($this->object, 'translatorsScopeNote', 'string');
    }

    public function testAddGetRelatedRegistryNumbers(): void
    {
        $this->addTextToListTest($this->object, 'relatedRegistryNumber');
    }

    public function testAddGetConceptRelations(): void
    {
        $this->addModelToListTest($this->object, 'conceptRelation', 'ConceptRelation');
    }

    public function testAddGetTerms(): void
    {
        $this->addModelToListTest($this->object, 'term', 'Term');
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
