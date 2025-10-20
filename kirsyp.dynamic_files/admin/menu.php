<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

$menu = array(
    array(
        'parent_menu' => 'global_menu_kirsyp',
        'sort' => 5000,
        'text' => 'Динамические файлы',
        'title' => 'Модуль для подключения файлов',
        "icon" => "iblock_menu_icon_settings",
        "page_icon" => "iblock_menu_icon_settings",
        'url' => 'kirsyp_dynamic_files_settings_admin.php?lang=' . LANGUAGE_ID,
        'items_id' => 'menu_kirsyp.dynamic_files',
        'menu_id' => 'global_kirsyp_dynamic_files',
        "items" => [
            [
                "text" => "Настройка динамических файлов",
                "url" => 'kirsyp_dynamic_files_settings_admin.php?lang=' . LANGUAGE_ID,
                "more_url" => [],
                "title" => "Настройки",
            ],
        ]
    ),
);

return $menu;
