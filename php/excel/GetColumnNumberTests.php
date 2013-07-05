<?php
require __DIR__."/GetColumnNumber.php";

class GetColumnNumberTests extends PHPUnit_Framework_TestCase
{
    public function SingleLetters()
    {
        return array(
            array(0, 'A'),
            array(1, 'B'),
            array(2, 'C'),
            array(10, 'K'),
            array(11, 'L'),
            array(25, 'Z'),
        );
    }

    /**
     * @test
     * @dataProvider SingleLetters
     */
    public function itShouldConvertToSingleLetters($index, $expectedLetter)
    {
        $letter = getExcelColumnName($index);
        $this->assertEquals($expectedLetter, $letter);
    }

    public function DoubleLetters()
    {
        return array(
            array(26, 'AA'),
            array(30, 'AE'),
            array(51, 'AZ'),
            array(52, 'BA'),
            array(77, 'BZ'),
            array(78, 'CA'),
        );
    }

    /**
     * @test
     * @dataProvider DoubleLetters
     */
    public function itShouldConvertToDoubleLetters($index, $expectedLetter)
    {
        $letter = getExcelColumnName($index);
        $this->assertEquals($expectedLetter, $letter);
    }
}