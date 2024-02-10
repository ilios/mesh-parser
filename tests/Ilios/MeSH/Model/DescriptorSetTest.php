<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class DescriptorSetTest
 *
 * @package Ilios\MeSH\Model
 * #[CoversClass(DescriptorSet::class)]
 */
class DescriptorSetTest extends BaseTestCase
{
    protected DescriptorSet $object;

    public function setUp(): void
    {
        parent::setUp();
        $this->object = new DescriptorSet();
    }

    public function testConstructor(): void
    {
        $this->assertEmpty($this->object->getDescriptors());
        $this->assertEmpty($this->object->getDescriptorUis());
    }

    public function testGetSetLanguageCode(): void
    {
        $this->basicSetTest($this->object, 'languageCode', 'string');
    }

    public function testAddGetDescriptors(): void
    {
        $descriptor = new Descriptor();
        $descriptor->setUi('D0000001');
        $this->object->addDescriptor($descriptor);
        $this->assertEquals(count($this->object->getDescriptors()), 1);
        $this->assertEquals($this->object->getDescriptors()[0], $descriptor);

        $descriptor2 = new Descriptor();
        $descriptor2->setUi('D0000002');
        $this->object->addDescriptor($descriptor2);
        $this->assertEquals(count($this->object->getDescriptors()), 2);
        $this->assertEquals($this->object->getDescriptors()[1], $descriptor2);

        $descriptor3 = new Descriptor();
        $descriptor3->setUi('D0000002');
        $this->object->addDescriptor($descriptor3);
        $this->assertEquals(count($this->object->getDescriptors()), 2);
        $this->assertEquals($this->object->getDescriptors()[1], $descriptor3);
    }

    public function testGetSetDescriptorUis(): void
    {
        $uis = ['D000001', 'D000002'];
        foreach ($uis as $ui) {
            $descriptor = new Descriptor();
            $descriptor->setUi($ui);
            $this->object->addDescriptor($descriptor);
        }

        $results = $this->object->getDescriptorUis();

        $this->assertEquals(2, count($results));
        $this->assertEmpty(array_diff($uis, $results));
        $this->assertEmpty(array_diff($results, $uis));
    }

    public function testFindDescriptorByUi(): void
    {
        $ui = 'D000001';
        $descriptor = new Descriptor();
        $descriptor->setUi($ui);
        $this->object->addDescriptor($descriptor);
        $this->assertEquals($descriptor, $this->object->findDescriptorByUi($ui));

        $this->assertFalse($this->object->findDescriptorByUi('nada'));
    }
}
