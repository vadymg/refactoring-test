<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @covers isEu
 */
class IsEuTest extends TestCase
{

    public function testIsEuWithEuCountry()
    {
        $country = 'DK';

        $result = isEu($country);

        $this->assertTrue($result);
    }

    public function testIsEuWithNonEuCountry()
    {
        $country = 'US';

        $result = isEu($country);

        $this->assertFalse($result);
    }

    public function testIsEuWithInvalidCountry()
    {
        $country = 'invalid';

        $result = isEu($country);

        $this->assertFalse($result);
    }
}