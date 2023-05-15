<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @covers getExchangeRate
 */
class GetExchangeRate extends TestCase
{

    public function testGetExchangeRateWithValidCurrency()
    {
        $currency = 'USD';
        $mockedData = [
            'rates' => [
                'USD' => 1.2
            ]
        ];
        $getExchangeRate = $this->getFunctionMock(__NAMESPACE__, "getExchangeRate");
        $getExchangeRate->expects($this->once())->willReturn($mockedData);

        $result = getExchangeRate($currency);

        $this->assertEquals($mockedData['rates']['USD'], $result['rates']['USD']);
    }

    public function testGetExchangeRateWithInvalidCurrency()
    {
        $currency = 'invalid';
        $expectedExceptionMessage = 'Invalid currency';
        $getExchangeRate = $this->getFunctionMock(__NAMESPACE__, "getExchangeRate");
        $getExchangeRate->expects($this->once())->willThrowException(new \Exception($expectedExceptionMessage));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        getExchangeRate($currency);
    }

}