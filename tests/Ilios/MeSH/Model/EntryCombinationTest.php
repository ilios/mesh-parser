<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class EntryCombinationTest
 *
 * @package Ilios\MeSH\Model
 * #[CoversClass(EntryCombination::class)]
 */
class EntryCombinationTest extends BaseTestCase
{
    protected EntryCombination $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new EntryCombination();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->object);
    }

    public function testGetSetDescriptorIn(): void
    {
        $this->modelSetTest($this->object, 'descriptorIn', 'Reference');
    }

    public function testGetSetDescriptorOut(): void
    {
        $this->modelSetTest($this->object, 'descriptorOut', 'Reference');
    }

    public function testGetSetQualifierIn(): void
    {
        $this->modelSetTest($this->object, 'qualifierIn', 'Reference');
    }

    public function testGetSetQualifierOut(): void
    {
        $this->modelSetTest($this->object, 'qualifierOut', 'Reference');
    }
}
