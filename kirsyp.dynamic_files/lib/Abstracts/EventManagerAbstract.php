<?php

namespace KirSyp\DynamicFiles\Abstracts;

use Bitrix\Main\EventManager;

abstract class EventManagerAbstract
{
    abstract public static function getModule(): string;

    abstract public static function getEvents(): array;

    public static function registerEvent($toModuleId)
    {
        self::runEvent('registerEventHandler', static::getModule(), $toModuleId);
    }
    public static function unRegisterEvent($toModuleId)
    {
        self::runEvent('unRegisterEventHandler', static::getModule(), $toModuleId);
    }

    private static function runEvent($methodRun, $fromModuleId, $toModuleId)
    {
        foreach (static::getEvents() as $event => $object) {

            $toClass = $object;
            $toMethod = lcfirst($event);

            if (is_array($object)) {
                $toClass = $object[0];
                $toMethod = $object[1];
            }

            EventManager::getInstance()->$methodRun(
                $fromModuleId,
                $event,
                $toModuleId,
                $toClass,
                $toMethod
            );
        }
    }
}
