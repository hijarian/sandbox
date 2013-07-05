<?php
class CarController
{
    public function getReadyToGo(Engine $engine, Gearbox $gearbox, Electronics $electronics, Lights $lights)
    {
        $engine->start();
        $gearbox->shift('N');
        $electronics->turnOn($lights);
        return true;
    }

    public function goForward(Electronics $electronics, StatusPanel $statusPanel = null)
    {
        $statusPanel = $statusPanel ? : new StatusPanel();
        if ($statusPanel->engineIsRunning() && $statusPanel->thereIsEnoughFuel())
        {
            $electronics->accelerate();
        }
    } 
}