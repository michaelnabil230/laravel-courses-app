<?php

namespace App\Traits;

trait SendsAlerts
{
    protected function success(string $id = null, $parameters = [])
    {
        $this->sendAlert('success', $id, $parameters);
    }

    protected function error(string $id = null, $parameters = [])
    {
        $this->sendAlert('error', $id, $parameters);
    }

    protected function warning(string $id = null, $parameters = [])
    {
        $this->sendAlert('warning', $id, $parameters);
    }

    protected function info(string $id = null, $parameters = [])
    {
        $this->sendAlert('info', $id, $parameters);
    }

    private function sendAlert(string $type, string $id = null, $parameters = [])
    {
        session()->flash($type, __($id, (array) $parameters));
    }
}
