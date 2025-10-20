<?php

use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;
use Bitrix\Main\IO\Directory;
use KirSyp\DynamicFiles\Providers\EventProvider;

class kirsyp_dynamic_files extends CModule
{
    var $MODULE_ID = "kirsyp.dynamic_files";
    var $MODULE_NAME;

    function __construct()
    {
        include(__DIR__ . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = 'Динамические файлы';
        $this->MODULE_DESCRIPTION = 'Динамические файлы';
        $this->PARTNER_NAME = 'ПервыйБит';
        $this->PARTNER_URI = 'https://kirsyp.ru';
    }

    function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->installFiles();

        $this->installEvents();
    }

    function DoUninstall()
    {
        $this->unInstallFiles();

        $this->unInstallEvents();

        // Option::delete($this->MODULE_ID);

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    function installFiles()
    {
        CopyDirFiles(
            __DIR__ . "/admin",
            Application::getDocumentRoot() . "/bitrix/admin",
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . '/assets/js',
            Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID,
            true,
            true
        );

        CopyDirFiles(
            __DIR__ . '/assets/css',
            Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID,
            true,
            true
        );


        return true;
    }

    function unInstallFiles()
    {

        DeleteDirFiles(__DIR__ . "/admin/", Application::getDocumentRoot() . "/bitrix/admin");

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/js/" . $this->MODULE_ID
        );

        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/css/" . $this->MODULE_ID
        );

        return false;
    }

    public function installEvents()
    {
        // событие для подключения скриптов
        Loader::includeModule($this->MODULE_ID);

        EventProvider::init($this->MODULE_ID)->register();

        return false;
    }

    public function unInstallEvents()
    {
        Loader::includeModule($this->MODULE_ID);

        EventProvider::init($this->MODULE_ID)->unRegister();

        return true;
    }

}
