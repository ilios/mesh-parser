<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class ConceptRelationTest
 *
 * @package Ilios\MeSH\Model
 */
#[CoversClass(ConceptRelation::class)]
class ConceptRelationTest extends BaseTestCase
{
    protected ConceptRelation $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new ConceptRelation();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
    }

    public function testGetSetName(): void
    {
        $this->basicSetTest($this->object, 'name', 'string', true);
    }

    public function testGetSetConcept1Ui(): void
    {
        $this->basicSetTest($this->object, 'concept1Ui', 'string');
    }

    public function testGetSetConcept2Ui(): void
    {
        $this->basicSetTest($this->object, 'concept2Ui', 'string');
    }
}
