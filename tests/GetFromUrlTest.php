<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;
use phpmock\phpunit\PHPMock;

/**
 * @covers getFromUrl
 */
class GetFromUrlTest extends TestCase
{
    use PHPMock;

    public function testGetFromUrlWithValidUrl()
    {
        $url = 'https://my-dummy-url.com';
        $mockedData = [
            'country' => [
                'alpha2' => 'ES',
            ]
        ];
        $fileGetContentsMock = $this->getFunctionMock(__NAMESPACE__, 'getFromUrl');
        $fileGetContentsMock->expects($this->once())
            ->willReturn($mockedData);

        $result = getFromUrl($url);
        $this->assertEquals($mockedData['country']['alpha2'], $result['country']['alpha2']);
    }

    public function testGetFromUrlWithInvalidUrl()
    {
        $url = 'https://my-dummy-url.com';
        $mockedData = [];
        $fileGetContentsMock = $this->getFunctionMock(__NAMESPACE__, 'getFromUrl');
        $fileGetContentsMock->expects($this->once())
            ->willReturn($mockedData);

        $result = getFromUrl($url);
        $this->assertEquals($mockedData, $result);
    }

    public function testGetFromUrlWithException()
    {
        $url = 'https://my-dummy-url.com';
        $fileGetContentsMock = $this->getFunctionMock(__NAMESPACE__, 'getFromUrl');
        $fileGetContentsMock->expects($this->once())
            ->willThrowException(new \Exception('Invalid json: Syntax error'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid json: Syntax error');

        getFromUrl($url);
    }

}