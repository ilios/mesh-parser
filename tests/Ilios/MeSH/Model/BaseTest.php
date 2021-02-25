<?php

namespace Ilios\MeSH\Model;

use PHPUnit\Framework\TestCase;
use \Mockery as m;
use \Faker\Factory as faker;

/**
 * Class BaseTest
 * @package Ilios\MeSH\Model
 */
abstract class BaseTest extends TestCase
{
    public function tearDown(): void
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
    protected function getGetMethodForListProperty($property)
    {
        return 'get' . ucfirst($property) . 's';
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
     * A generic test for setters methods.
     *
     * @param object $model
     * @param string $property
     * @param string $type
     */
    protected function basicSetTest($model, $property, $type)
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $getMethod = $this->getGetMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method {$setMethod} missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method {$getMethod} missing");
        $expected = $this->getValueForType($type);
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$getMethod());
    }

    /**
     * A generic test method for getters/setters of model-type properties.
     *
     * @param object $model
     * @param string $property
     * @param string $modelName
     */
    protected function modelSetTest($model, $property, $modelName)
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $getMethod = $this->getGetMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method {$setMethod} missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method {$getMethod} missing");
        $expected = m::mock('Ilios\\MeSH\\Model\\' .$modelName);
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$getMethod());
    }

    /**
     * A generic test for boolean setter methods.
     *
     * @param object $model
     * @param string $property
     * @param boolean $is should we use is vs has when generating the method.
     */
    protected function booleanSetTest($model, $property, $is = true)
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $isMethod = $is?$this->getIsMethodForProperty($property):$this->getHasMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method {$setMethod} missing");
        $this->assertTrue(method_exists($model, $isMethod), "Method {$isMethod} missing");
        $expected = $this->getValueForType('boolean');
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$isMethod());
    }

    /**
     * A generic test for model setters which hold lists of other models.
     *
     * @param object $model
     * @param string $property
     * @param string $modelName
     * @param string|bool $getter name of the method to use instead of a generated method, or FALSE if n/a.
     * @param string|bool $setter name of the method to use instead of a generated method, or FALSE if n/a.
     */
    protected function addModelToListTest($model, $property, $modelName, $getter = false, $setter = false)
    {
        $n = 10;
        $arr = $this->getArrayOfMockObjects('Ilios\\MeSH\\Model\\' . $modelName, $n);
        $addMethod = $setter?$setter:$this->getAddMethodForProperty($property);
        $getMethod = $getter?$getter:$this->getGetMethodForListProperty($property);
        $this->assertTrue(method_exists($model, $addMethod), "Method {$addMethod} missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method {$getMethod} missing");
        foreach ($arr as $obj) {
            $model->$addMethod($obj);
        }
        $results = $model->$getMethod();
        $this->assertTrue(is_array($results), "{$getMethod} did not return an array.");
        $this->assertEquals(count($results), $n);
        for ($i = 0; $i < $n; $i++) {
            $this->assertEquals($results[$i], $arr[$i]);
        }
    }

    /**
     * A generic test for model setters which hold lists of text.
     *
     * @param object $model
     * @param string $property
     * @param string|bool $getter name of the method to use instead of a generated method, or FALSE if n/a.
     * @param string|bool $setter name of the method to use instead of a generated method, or FALSE if n/a.
     */
    public function addTextToListTest($model, $property, $getter = false, $setter = false)
    {
        $n = 10;
        $arr = [];
        for ($i = 0; $i < $n; $i++) {
            $arr[] = $this->getValueForType('string');
        }
        $addMethod = $setter?$setter:$this->getAddMethodForProperty($property);
        $getMethod = $getter?$getter:$this->getGetMethodForListProperty($property);
        $this->assertTrue(method_exists($model, $addMethod), "Method {$addMethod} missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method {$getMethod} missing");
        foreach ($arr as $obj) {
            $model->$addMethod($obj);
        }
        $results = $model->$getMethod();
        $this->assertTrue(is_array($results), "{$getMethod} did not return an array.");
        $this->assertEquals(count($results), $n);
        for ($i = 0; $i < $n; $i++) {
            $this->assertEquals($results[$i], $arr[$i]);
        }
    }
}
