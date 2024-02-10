<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class ReferenceTest
 *
 * @package Ilios\MeSH\Model
 * #[CoversClass(Reference::class)]
 */
class ReferenceTest extends BaseTestCase
{
    protected Reference $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new Reference();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
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
