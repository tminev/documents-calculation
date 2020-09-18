<?php

namespace UnitTest\Infrastructure\Services;

use Infrastructure\Services\Validator;
use Codeception\Test\Unit;

/**
 * Class ValidatorTest
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class ValidatorTest extends Unit
{
    private $validator;

    public function setUp(): void
    {
        $this->validator = new Validator();
    }

    /**
     * Tests the validator with valid set of data
     */
    public function testValidationOnValidData()
    {
        $data = [
            'key1' => 'value1'
        ];
        $validationRules = [
            [
                'name' => 'key1',
                'required' => true,
            ],
        ];

        $this->assertEmpty($this->validator->validate($validationRules, $data));
    }

    /**
     * Tests the validator with invalid set of data
     */
    public function testValidationOnInvalidData()
    {
        $data = [];
        $validationRules = [
            [
                'name' => 'key1',
                'required' => true,
            ],
        ];

        $this->assertNotEmpty($this->validator->validate($validationRules, $data));
    }
}