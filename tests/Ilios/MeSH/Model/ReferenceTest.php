<?php

namespace Ilios\MeSH\Model;

/**
 * Class ReferenceTest
 * @package Ilios\MeSH\Model
 */
class ReferenceTest extends BaseTest
{
    /**
     * @var Reference
     */
    protected $object;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = new Reference();
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
     * @covers \Ilios\MeSH\Model\Reference::getUi
     * @covers \Ilios\MeSH\Model\Reference::setUi
     */
    public function testGetSetUi()
    {
        $this->basicSetTest($this->object, 'ui', 'string');
    }

    /**
     * @covers \Ilios\MeSH\Model\Reference::getName
     * @covers \Ilios\MeSH\Model\Reference::setName
     */
    public function testGetSetName()
    {
        $this->basicSetTest($this->object, 'name', 'string');
    }
}
