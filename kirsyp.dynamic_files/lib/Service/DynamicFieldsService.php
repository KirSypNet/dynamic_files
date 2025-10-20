<?php

namespace KirSyp\DynamicFiles\Service;

use Bitrix\Main\Loader;

use Bitrix\Main\Config\Option;


class DynamicFilesService
{
    protected $factory;
    protected $dynamicEntityFields;

    public function __construct()
    {
        // подключаем необходимые модули
        Loader::includeModule('crm');
        Loader::includeModule('iblock');
    }

    public function getDynamicFilesData(): array
    {
        $returnFields = [];

        $dealCategoryIdDynamicList = Option::get("kirsyp.dynamic_files", 'deal_category_id_dynamic_list', '');


        $returnFields = [
            'deal_category' => $dealCategoryIdDynamicList,
        ];
        return $returnFields;
    }
}
