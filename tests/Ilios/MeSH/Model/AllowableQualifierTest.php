<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class AllowableQualifierTest
 *
 * @package Ilios\MeSH\Model
 */
#[CoversClass(AllowableQualifier::class)]
class AllowableQualifierTest extends BaseTestCase
{
    protected AllowableQualifier $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new AllowableQualifier();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
    }

    public function testGetSetQualifierReference(): void
    {
        $this->modelSetTest($this->object, 'qualifierReference', 'Reference');
    }

    public function testGetSetAbbreviation(): void
    {
        $this->basicSetTest($this->object, 'abbreviation', 'string');
    }
}
