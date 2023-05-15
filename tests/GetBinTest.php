<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;
use phpmock\phpunit\PHPMock;

/**
 * @covers getBin
 */
class GetBinTest extends TestCase
{
    use PHPMock;

    public function testGetBinWithValidBin()
    {
        $bin = '45717360';
        $mockedData = [
            'country' => [
                'alpha2' => 'DK'
            ]
        ];
        $getBin = $this->getFunctionMock(__NAMESPACE__, "getBin");
        $getBin->expects($this->once())->willReturn($mockedData);

        $result = getBin($bin);

        $this->assertEquals($mockedData['country']['alpha2'], $result['country']['alpha2']);
    }

    public function testGetBinWithInvalidBin()
    {
        $bin = '45717361';
        $expectedExceptionMessage = 'Invalid bin';
        $getBin = $this->getFunctionMock(__NAMESPACE__, "getBin");
        $getBin->expects($this->once())->willThrowException(new \Exception($expectedExceptionMessage));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        getBin($bin);
    }
}