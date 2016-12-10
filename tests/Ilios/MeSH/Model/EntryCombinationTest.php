<?php

namespace Ilios\MeSH\Model;

/**
 * Class EntryCombinationTest
 * @package Ilios\MeSH\Model
 */
class EntryCombinationTest extends BaseTest
{
    /**
     * @var EntryCombination
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new EntryCombination();
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
     * @covers \Ilios\MeSH\Model\EntryCombination::getDescriptorIn
     * @covers \Ilios\MeSH\Model\EntryCombination::setDescriptorIn
     */
    public function testGetSetDescriptorIn()
    {
        $this->modelSetTest($this->object, 'descriptorIn', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\EntryCombination::getDescriptorOut
     * @covers \Ilios\MeSH\Model\EntryCombination::setDescriptorOut
     */
    public function testGetSetDescriptorOut()
    {
        $this->modelSetTest($this->object, 'descriptorOut', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\EntryCombination::getQualifierIn
     * @covers \Ilios\MeSH\Model\EntryCombination::setQualifierIn
     */
    public function testGetSetQualifierIn()
    {
        $this->modelSetTest($this->object, 'qualifierIn', 'Reference');
    }

    /**
     * @covers \Ilios\MeSH\Model\EntryCombination::getQualifierOut
     * @covers \Ilios\MeSH\Model\EntryCombination::setQualifierOut
     */
    public function testGetSetQualifierOut()
    {
        $this->modelSetTest($this->object, 'qualifierOut', 'Reference');
    }
}
