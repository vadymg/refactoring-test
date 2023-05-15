<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @covers isLineDataValid
 */
class IsLineDataValidTest extends TestCase
{

    public function testIsLineDataValidWithValidData()
    {
        $data = [
            'bin' => '123456',
            'currency' => 'USD',
            'amount' => 100.00
        ];

        $result = isLineDataValid($data);

        $this->assertTrue($result);
    }

    public function testIsLineDataValidWithInvalidData()
    {
        $data = [
            'bin' => '123456',
            'currency' => 'USD',
            'amount' => 'amount'
        ];

        $result = isLineDataValid($data);

        $this->assertFalse($result);
    }

    public function testIsLineDataValidWithNoKey()
    {
        $data = [
            'bin' => '123456',
            'currency' => 'USD',
        ];

        $result = isLineDataValid($data);

        $this->assertFalse($result);
    }

}