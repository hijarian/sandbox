<?php

namespace Hijarian\HelloWorld\Tests;

require_once __DIR__ . '/../src/HelloWorld.php';

class HelloWorldTest extends \PHPUnit_Framework_TestCase {
	public function testShouldEchoHelloWorld() {
  	$runner = new \Hijarian\HelloWorld\Runner\HelloWorld();
		$this->expectOutputString('Hello, World!');
    $runner->run();
  }
}
