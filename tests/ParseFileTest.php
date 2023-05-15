<?php

namespace RefactoringTest\Tests;

use PHPUnit\Framework\TestCase;

/**
 * @covers parseFile
 */
class ParseFileTest extends TestCase
{

    public function testParseFileWithEmptyFileName()
    {
        $expectedOutput = "\033[31mUsage: php app.php <input_file> <decimals>\033[0m";
        $output = exec('php src/app.php');

        $this->assertEquals($expectedOutput, $output);
    }

    public function testParseFileWithInvalidFileName()
    {
        $expectedOutput = "\033[31mFile not found: \"invalid\"\033[0m";
        $output = exec('php src/app.php invalid');

        $this->assertEquals($expectedOutput, $output);
    }

    public function testParseFileWithInvalidDecimals()
    {
        $expectedOutput = "\033[31mDecimals must be between 0 and 10\033[0m";
        $output = exec("php src/app.php tests/test_files/input.txt invalid");

        $this->assertEquals($expectedOutput, $output);
    }

}