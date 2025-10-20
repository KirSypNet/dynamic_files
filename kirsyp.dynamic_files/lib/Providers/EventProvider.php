<?php

namespace KirSyp\DynamicFiles\Providers;

use KirSyp\DynamicFiles\Events\MainEvent;

class EventProvider 
{
    private array $serviceEvents = [];

    private string $moduleId;

    public function __construct(string $moduleId)
    {
        $this->serviceEvents = [
            MainEvent::class,
        ];

        $this->moduleId = $moduleId;
    }

    public static function init(string $moduleId): self
    {
        return new self($moduleId);
    }

    private function run(string $method)
    {
        foreach($this->serviceEvents as $eventClass) {
            $eventClass::$method($this->moduleId);
        }
    }

    public function register()
    {
        $this->run('registerEvent');
    }

    public function unRegister()
    {
        $this->run('unRegisterEvent');
    }
}
