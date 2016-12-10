<?php

namespace Ilios\MeSH\Model;

/**
 * Class DescriptorSetTest
 * @package Ilios\MeSH\Model
 */
class DescriptorSetTest extends BaseTest
{
    /**
     * @var DescriptorSet
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new DescriptorSet();
    }

    /**
     * @covers \Ilios\MeSH\Model\DescriptorSet::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->object->getDescriptors());
        $this->assertEmpty($this->object->getDescriptorUis());
    }

    /**
     * @covers \Ilios\MeSH\Model\DescriptorSet::setLanguageCode
     * @covers \Ilios\MeSH\Model\DescriptorSet::getLanguageCode
     */
    public function testGetSetLanguageCode()
    {
        $this->basicSetTest($this->object, 'languageCode', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\DescriptorSet::addDescriptor
     * @covers \Ilios\MeSH\Model\DescriptorSet::getDescriptors
     */
    public function testAddGetDescriptors()
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

    /**
     * @covers \Ilios\MeSH\Model\DescriptorSet::getDescriptorUis
     */
    public function testGetSetDescriptorUis()
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

    /**
     * @covers \Ilios\MeSH\Model\DescriptorSet::getDescriptorByUi
     */
    public function testFindDescriptorByUi()
    {
        $ui = 'D000001';
        $descriptor = new Descriptor();
        $descriptor->setUi($ui);
        $this->object->addDescriptor($descriptor);
        $this->assertEquals($descriptor, $this->object->findDescriptorByUi($ui));

        $this->assertFalse($this->object->findDescriptorByUi('nada'));
    }
}
