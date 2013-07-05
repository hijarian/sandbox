<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class WebTest extends PHPUnit_Extensions_SeleniumTestCase
{
	protected function setUp()
	{
		$this->setBrowser('*firefox');
		$this->setBrowserUrl('http://google.ru/');
	}

	public function testTitle()
	{
		$this->open('/');
		$this->assertTitle('Google');
	}	
}
?>
