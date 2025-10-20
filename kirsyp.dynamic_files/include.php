<?php

use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

Loader::registerAutoLoadClasses("kirsyp.dynamic_files", array(
    "KirSyp\\DynamicFiles\\Abstracts\\EventManagerAbstract" => "lib/Abstracts/EventManagerAbstract.php",
    "KirSyp\\DynamicFiles\\Controller\\DynamicFilesAjaxController" => "lib/Controller/DynamicFilesAjaxController.php",
    "KirSyp\\DynamicFiles\\Events\\MainEvent" => "lib/Events/MainEvent.php",
    "KirSyp\\DynamicFiles\\Providers\\EventProvider" => "lib/Providers/EventProvider.php",
    "KirSyp\\DynamicFiles\\Service\\MainEventService" => "lib/Service/MainEventService.php",
    "KirSyp\\DynamicFiles\\Service\\DynamicFilesService" => "lib/Service/DynamicFilesService.php",
));