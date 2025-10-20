<?php

namespace KirSyp\DynamicFiles\Events;

use KirSyp\DynamicFiles\Abstracts\EventManagerAbstract;
use KirSyp\DynamicFiles\Service\MainEventService;

class MainEvent extends EventManagerAbstract
{
    public static function getModule(): string
    {
        return 'main';
    }

    public static function getEvents(): array
    {
        return [
            'OnBeforeProlog'        => MainEventService::class,
        ];
    }
}
