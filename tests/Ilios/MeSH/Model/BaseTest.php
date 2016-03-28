<?php

namespace Ilios\MeSH\Model;

use \PHPUnit_Framework_TestCase;
use \Mockery as m;
use \Faker\Factory as faker;

/**
 * Class BaseTest
 * @package Ilios\MeSH\Model
 */
abstract class BaseTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @param $className
     * @param $count
     * @return array
     */
    protected function getArrayOfMockObjects($className, $count)
    {
        $arr = array();
        for ($i = 0; $i < $count; $i++) {
            $arr[] = m::mock($className);
        }

        return $arr;
    }

    /**
     * @param $property
     * @return string
     */
    protected function getSetMethodForProperty($property)
    {
        return 'set' . ucfirst($property);
    }

    /**
     * @param $property
     * @return string
     */
    protected function getGetMethodForProperty($property)
    {
        return 'get' . ucfirst($property);
    }

    /**
     * @param $property
     * @return string
     */
    protected function getIsMethodForProperty($property)
    {
        return 'is' . ucfirst($property);
    }

    /**
     * @param $property
     * @return string
     */
    protected function getHasMethodForProperty($property)
    {
        return 'has' . ucfirst($property);
    }

    /**
     * @param $property
     * @return string
     */
    protected function getGetMethodForCollectionProperty($property)
    {
        return 'get' . ucfirst($property) . 's';
    }

    /**
     * @param $property
     * @return string
     */
    protected function getSetMethodForCollectionProperty($property)
    {
        return 'set' . ucfirst($property) . 's';
    }

    /**
     * @param $property
     * @return string
     */
    protected function getAddMethodForProperty($property)
    {
        return 'add' . ucfirst($property);
    }

    /**
     * @param $property
     * @return string
     */
    protected function getRemoveMethodForProperty($property)
    {
        return 'remove' . ucfirst($property);
    }

    /**
     * @param string $type
     * @return \DateTime|float|int|bool|string
     * @throws \Exception
     */
    protected function getValueForType($type)
    {
        $faker = faker::create();
        switch ($type) {
            case 'integer':
                return $faker->randomNumber();
            case 'float':
                return $faker->randomFloat();
            case 'string':
                return $faker->text;
            case 'email':
                return $faker->email;
            case 'phone':
                return $faker->phoneNumber;
            case 'datetime':
                return $faker->dateTime;
            case 'bool':
            case 'boolean':
                return $faker->boolean();
            default:
                throw new \Exception("No values for type {$type}");
        }
    }

    /**
     * A generic test for entity setters.
     *
     * @param string $property
     * @param string $type
     */
    protected function basicSetTest($property, $type)
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $getMethod = $this->getGetMethodForProperty($property);
        $this->assertTrue(method_exists($this->object, $setMethod), "Method {$setMethod} missing");
        $this->assertTrue(method_exists($this->object, $getMethod), "Method {$getMethod} missing");
        $expected = $this->getValueForType($type);
        $this->object->$setMethod($expected);
        $this->assertSame($expected, $this->object->$getMethod());
    }
}
