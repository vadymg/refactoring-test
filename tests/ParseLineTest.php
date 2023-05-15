<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @covers parseLine
 */
class ParseLineTest extends TestCase
{
    public function testParseLineWithValidJson()
    {
        $line = '{"bin": "123456", "currency": "USD", "amount": 100.00}';
        $expectedData = [
            'bin' => '123456',
            'currency' => 'USD',
            'amount' => 100.00
        ];

        $result = parseLine($line);

        $this->assertEquals($expectedData, $result);
    }

    public function testParseLineWithInvalidJson()
    {
        $line = '{"bin": "123456", "currency": "USD", "amount": 100.00';
        $expectedExceptionMessage = 'Invalid json: Syntax error';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        parseLine($line);
    }

    public function testParseLineWithInvalidLineData()
    {
        $line = '{"bin": "123456"}';
        $expectedExceptionMessage = 'Invalid line data';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        parseLine($line);
    }
}
