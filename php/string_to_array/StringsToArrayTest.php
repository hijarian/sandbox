<?php
require "StringsToArray.php";

class StringsToArrayTest extends PHPUnit_Framework_TestCase
{
	public function testConvertEmptyStringToEmptyArray()
	{
		$this->assertEquals(array(), convertStringsToMultiArrayByColumns('', 5));
	}

	public function testOneColumnIsTwoLevelArray()
	{
		$string = <<<ENDL
alpha
beta
gamma
delta
ENDL;
		$expected_array = array(array('alpha', 'beta', 'gamma', 'delta'));
		$this->assertEquals(
			$expected_array,
			convertStringsToMultiArrayByColumns($string, 1)
		);
	}

	public function testTwoColumnsIsDividingInHalf()
	{
		$string = <<<ENDL
alpha
beta
gamma
delta
ENDL;
		$expected_array = array(array('alpha', 'beta'), array('gamma', 'delta'));
		$this->assertSame(
			$expected_array,
			convertStringsToMultiArrayByColumns($string, 2)
		);
	}

	public function testUnevenDividingShortensLastColumn()
	{
		$string = <<<ENDL
alpha
beta
gamma
delta
epsilon
ENDL;
		$expected_array = array(array('alpha', 'beta', 'gamma'), array('delta', 'epsilon'));
		$this->assertSame(
			$expected_array,
			convertStringsToMultiArrayByColumns($string, 2)
		);
	}

	public function testIfColumnNumberGreaterThanStringNumberThenShortenResultArray()
	{
		$string = <<<ENDL
alpha
beta
gamma
ENDL;
		$expected_array = array(array('alpha'), array('beta'), array('gamma'));
		$this->assertSame(
			$expected_array,
			convertStringsToMultiArrayByColumns($string, 10)
		);
	}

	/**
	 * @dataProvider StringConversions
	 *
	 */
	public function testConvertNormalString($string, $column_count, $expected_array)
	{
// 		$this->markTestSkipped();
		$this->assertSame(
			$expected_array,
			convertStringsToMultiArrayByColumns($string, $column_count)
		);
	}

	public function StringConversions()
	{
		return array(
			array(<<<ENDL
alpha
beta
gamma
delta
ENDL
,
				4,
				array(
					array('alpha'),
					array('beta'),
					array('gamma'),
					array('delta')
				)
			),
			array(<<<ENDL
alpha
beta
gamma
ENDL
,
				2,
				array(
					array('alpha', 'beta'),
					array('gamma')
				)
			),
			array(<<<ENDL
01
02
03
04
05
06
07
08
09
10
11
12
13
14
ENDL
,
				3,
				array(
					array('01', '02', '03', '04', '05'),
					array('06', '07', '08', '09', '10'),
					array('11', '12', '13', '14')
				)
			)
		);
	}

}