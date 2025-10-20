<?php

$FILE_NAME = 'kirsyp_dynamic_files_settings_admin';
$MODULE_NAME = 'kirsyp.dynamic_files';

// определяем в какой папке находится модуль, если в bitrix, инклудим файл с меню из папки bitrix
if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/$MODULE_NAME/")) {
    // присоединяем и копируем файл
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/$MODULE_NAME/admin/" . $FILE_NAME . ".php");
}
// определяем в какой папке находится модуль, если в local, инклудим файл с меню из папки local
if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/local/modules/$MODULE_NAME/")) {
    // присоединяем и копируем файл
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/modules/$MODULE_NAME/admin/" . $FILE_NAME . ".php");
}

