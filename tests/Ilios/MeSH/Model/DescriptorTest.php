<?php

namespace Ilios\MeSH\Model;

/**
 * Class DescriptorTest
 * @package Ilios\MeSH\Model
 */
class DescriptorTest extends BaseTest
{
    /**
     * @var Descriptor
     */
    protected $object;
    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new Descriptor();
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
     * @covers Ilios\MeSH\Model\Descriptor::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->object->getConcepts());
        $this->assertEmpty($this->object->getEntryCombinations());
        $this->assertEmpty($this->object->getAllowableQualifiers());
    }

    /**
     * @covers Ilios\MeSH\Model\Descriptor::setClass
     * @covers Ilios\MeSH\Model\Descriptor::getClass
     */
    public function testGetSetClass()
    {
        $this->basicSetTest('class', 'string');
    }

    /**
     * @covers Ilios\MeSH\Model\Descriptor::setDateCreated
     * @covers Ilios\MeSH\Model\Descriptor::getDateCreated
     */
    public function testGetSetDateCreated()
    {
        $this->basicSetTest('dateCreated', 'datetime');
    }

    /**
     * @covers Ilios\MeSH\Model\Descriptor::setDateRevised
     * @covers Ilios\MeSH\Model\Descriptor::getDateRevised
     */
    public function testGetSetDateRevised()
    {
        $this->basicSetTest('dateRevised', 'datetime');
    }

    /**
     * @covers Ilios\MeSH\Model\Descriptor::setDateEstablished
     * @covers Ilios\MeSH\Model\Descriptor::getDateEstablished
     */
    public function testGetSetDateEstablished()
    {
        $this->basicSetTest('dateEstablished', 'datetime');
    }
}
