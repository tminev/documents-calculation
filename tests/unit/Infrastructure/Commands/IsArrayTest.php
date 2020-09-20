<?php

namespace UnitTest\Infrastructure\Validators;

use Codeception\Test\Unit;
use Infrastructure\Validators\IsArray;

/**
 * Class IsArrayTest
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class IsArrayTest extends Unit
{
    /**
     * Tests whether the validator works correctly
     */
    public function testIsValid()
    {
        $isArrayValidator = new IsArray();

        $testValue = 'string';
        $this->assertFalse($isArrayValidator->isValid($testValue));

        $testValue = 1;
        $this->assertFalse($isArrayValidator->isValid($testValue));

        $testValue = [1];
        $this->assertTrue($isArrayValidator->isValid($testValue));
    }

    /**
     * Tests whether the validation works with array of integers
     */
    public function testIsValidWithArrayOfIntegers()
    {
        $isArrayValidator = new IsArray(['content' => IsArray::ONLY_INT]);

        $testValue = ['asd'];
        $this->assertFalse($isArrayValidator->isValid($testValue));

        $testValue = ['1'];
        $this->assertTrue($isArrayValidator->isValid($testValue));

        $testValue = [1];
        $this->assertTrue($isArrayValidator->isValid($testValue));
    }
}