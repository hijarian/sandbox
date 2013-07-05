<?php

require_once 'CarController.php';
include 'autoloadCarInterfaces.php';
class CarControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itCanGetReadyTheCar()
    {
        $carController = new CarController();
        $engine = new Engine();
        $gearbox = new Gearbox();
        $electronics = new Electronics();
        $dummyLights = $this->getMock('Lights');
        $this->assertTrue($carController->getReadyToGo($engine, $gearbox, $electronics, $dummyLights));
    }

    /**
     * @test
     */
    public function itCanAccelerate()
    {
        $carController = new CarController();
        $electronics = new Electronics();
        $stubStatusPanel = $this->getMock('StatusPanel');
        $stubStatusPanel->expects($this->any())
            ->method('thereIsEnoughFuel')
            ->will($this->returnValue(true));
        $stubStatusPanel->expects($this->any())
            ->method('engineIsRunning')
            ->will($this->returnValue(true));
        $carController->goForward($electronics, $stubStatusPanel);
    }
}