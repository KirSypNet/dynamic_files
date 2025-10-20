<?php

namespace KirSyp\DynamicFiles\Service;

use Bitrix\Main\Config\Option;

class MainEventService
{

    static public function OnBeforeProlog()
    {
        \CJSCore::RegisterExt('insurance_data', array(
            'js' => '/bitrix/js/kirsyp.dynamic_files/insurance_data.js',
            'rel' => [
                'ajax',
                'sidepanel',
                'BX',
            ]
        ));

        \CJSCore::RegisterExt('dynamic_files', array(
            'js' => '/bitrix/js/kirsyp.dynamic_files/dynamic_files.js',
            'css' => '/bitrix/css/kirsyp.dynamic_files/search_list.css',
            'rel' => [
                'ajax',
                'sidepanel',
                'BX',
                'insurance_data'
            ]
        ));

        \CJSCore::RegisterExt('auto_won_deal', array(
            'js' => '/bitrix/js/kirsyp.dynamic_files/auto_won_deal.js',
            'rel' => [
                'ajax',
                'sidepanel',
                'BX',
            ]
        ));

        \CJSCore::RegisterExt('auto_won_deal_list', array(
            'js' => '/bitrix/js/kirsyp.dynamic_files/auto_won_deal_list.js',
            'rel' => [
                'ajax',
                'sidepanel',
                'BX',
            ]
        ));

        \CJSCore::RegisterExt('hide_kanban_lose_stage', array(
            'js' => '/bitrix/js/kirsyp.dynamic_files/hide_kanban_lose_stage.js',
            'rel' => [
                'ajax',
                'sidepanel',
                'BX',
            ]
        ));

        $currentUrl = $_SERVER['REQUEST_URI'];


        $dealCategoryIdDynamicList = Option::get("kirsyp.dynamic_files", 'deal_category_id_dynamic_list', '');

        if (strpos($_SERVER['REQUEST_URI'], 'IFRAME=Y&IFRAME_TYPE=SIDE_SLIDER') !== false && strpos($_SERVER['REDIRECT_SCRIPT_URL'] ?? $_SERVER['REQUEST_URI'], '/crm/deal/details/') !== false) {
            if (preg_match('/\/crm\/deal\/details\/(\d+)/', $currentUrl, $matches)) {
                $categoryId = null;
                $dealId = $matches[1];
                if ($dealId != 0) {
                    if (\Bitrix\Main\Loader::IncludeModule('crm')) {
                        if (\Bitrix\Main\Loader::IncludeModule('iblock')) {
                            $deal = \CCrmDeal::GetByID($dealId);
                            $categoryId = $deal['CATEGORY_ID'];
                            if ($categoryId && $categoryId == $dealCategoryIdDynamicList) {
                                \CJSCore::Init('auto_won_deal');
                            } 
                        }
                    }
                }
            }
        }

        if (preg_match('/\/crm\/deal\/kanban\/category\/(\d+)/', $currentUrl, $matches)) {
            $categoryURI = $matches[1];
            if ($categoryURI && $categoryURI == $dealCategoryIdDynamicList) {
                \CJSCore::Init('hide_kanban_lose_stage');
            }
        }

        if (preg_match('/\/crm\/deal\/category\/(\d+)/', $currentUrl, $matches)) {
            $categoryURI = $matches[1];
            if ($categoryURI && $categoryURI == $dealCategoryIdDynamicList) {
                \CJSCore::Init('auto_won_deal_list');
            }
        }
    }
}
