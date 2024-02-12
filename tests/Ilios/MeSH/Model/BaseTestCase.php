<?php

declare(strict_types=1);

namespace Ilios\MeSH\Model;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Mockery as m;
use Faker\Factory as faker;

/**
 * Class BaseTest
 *
 * @package Ilios\MeSH\Model
 */
abstract class BaseTestCase extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    protected function getArrayOfMockObjects(string $className, int $count): array
    {
        $arr = [];
        for ($i = 0; $i < $count; $i++) {
            $arr[] = m::mock($className);
        }

        return $arr;
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getSetMethodForProperty(string $property): string
    {
        return 'set' . ucfirst($property);
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getGetMethodForProperty(string $property): string
    {
        return 'get' . ucfirst($property);
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getIsMethodForProperty(string $property): string
    {
        return 'is' . ucfirst($property);
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getHasMethodForProperty(string $property): string
    {
        return 'has' . ucfirst($property);
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getGetMethodForListProperty(string $property): string
    {
        return 'get' . ucfirst($property) . 's';
    }

    /**
     * @param  string $property
     * @return string
     */
    protected function getAddMethodForProperty(string $property): string
    {
        return 'add' . ucfirst($property);
    }

    /**
     * @param  string $type
     * @return DateTime|float|int|bool|string
     * @throws Exception
     */
    protected function getValueForType(string $type): mixed
    {
        $faker = faker::create();
        return match ($type) {
            'integer' => $faker->randomNumber(),
            'float' => $faker->randomFloat(),
            'string' => $faker->text(),
            'email' => $faker->email(),
            'phone' => $faker->phoneNumber(),
            'datetime' => $faker->dateTime(),
            'bool', 'boolean' => $faker->boolean(),
            default => throw new Exception("No values for type $type"),
        };
    }

    /**
     * A generic test for setters methods.
     *
     * @param object $model
     * @param string $property
     * @param string $type
     * @param bool $nullable if TRUE then an additional getter/setter check for NULL is performed.
     * @throws Exception
     */
    protected function basicSetTest(object $model, string $property, string $type, bool $nullable = false): void
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $getMethod = $this->getGetMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method $setMethod missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method $getMethod missing");
        $expected = $this->getValueForType($type);
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$getMethod());
        if ($nullable) {
            $model->$setMethod(null);
            $this->assertNull($model->$getMethod());
        }
    }

    /**
     * A generic test method for getters/setters of model-type properties.
     *
     * @param object $model
     * @param string $property
     * @param string $modelName
     */
    protected function modelSetTest(object $model, string $property, string $modelName): void
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $getMethod = $this->getGetMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method $setMethod missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method $getMethod missing");
        $expected = m::mock('Ilios\\MeSH\\Model\\' . $modelName);
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$getMethod());
    }

    /**
     * A generic test for boolean setter methods.
     *
     * @param  object  $model
     * @param  string  $property
     * @param  boolean $is       should we use "is" vs "has" when generating the method?
     * @throws Exception
     */
    protected function booleanSetTest(object $model, string $property, bool $is = true): void
    {
        $setMethod = $this->getSetMethodForProperty($property);
        $isMethod = $is ? $this->getIsMethodForProperty($property) : $this->getHasMethodForProperty($property);
        $this->assertTrue(method_exists($model, $setMethod), "Method $setMethod missing");
        $this->assertTrue(method_exists($model, $isMethod), "Method $isMethod missing");
        $expected = $this->getValueForType('boolean');
        $model->$setMethod($expected);
        $this->assertSame($expected, $model->$isMethod());
    }

    /**
     * A generic test for model setters which hold lists of other models.
     *
     * @param object      $model
     * @param string      $property
     * @param string      $modelName
     * @param string|bool $getter    name of the method to use instead of a generated method, or FALSE if n/a.
     * @param string|bool $setter    name of the method to use instead of a generated method, or FALSE if n/a.
     */
    protected function addModelToListTest(
        object $model,
        string $property,
        string $modelName,
        string|bool $getter = false,
        string|bool $setter = false
    ): void {
        $n = 10;
        $arr = $this->getArrayOfMockObjects('Ilios\\MeSH\\Model\\' . $modelName, $n);
        $addMethod = $setter ?: $this->getAddMethodForProperty($property);
        $getMethod = $getter ?: $this->getGetMethodForListProperty($property);
        $this->assertTrue(method_exists($model, $addMethod), "Method $addMethod missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method $getMethod missing");
        foreach ($arr as $obj) {
            $model->$addMethod($obj);
        }
        $results = $model->$getMethod();
        $this->assertTrue(is_array($results), "$getMethod did not return an array.");
        $this->assertEquals(count($results), $n);
        for ($i = 0; $i < $n; $i++) {
            $this->assertEquals($results[$i], $arr[$i]);
        }
    }

    /**
     * A generic test for model setters which hold lists of text.
     *
     * @param  object      $model
     * @param  string      $property
     * @param  string|bool $getter   name of the method to use instead of a generated method, or FALSE if n/a.
     * @param  string|bool $setter   name of the method to use instead of a generated method, or FALSE if n/a.
     * @throws Exception
     */
    public function addTextToListTest(
        object $model,
        string $property,
        string|bool $getter = false,
        string|bool $setter = false
    ): void {
        $n = 10;
        $arr = [];
        for ($i = 0; $i < $n; $i++) {
            $arr[] = $this->getValueForType('string');
        }
        $addMethod = $setter ?: $this->getAddMethodForProperty($property);
        $getMethod = $getter ?: $this->getGetMethodForListProperty($property);
        $this->assertTrue(method_exists($model, $addMethod), "Method $addMethod missing");
        $this->assertTrue(method_exists($model, $getMethod), "Method $getMethod missing");
        foreach ($arr as $obj) {
            $model->$addMethod($obj);
        }
        $results = $model->$getMethod();
        $this->assertTrue(is_array($results), "$getMethod did not return an array.");
        $this->assertEquals(count($results), $n);
        for ($i = 0; $i < $n; $i++) {
            $this->assertEquals($results[$i], $arr[$i]);
        }
    }
}
