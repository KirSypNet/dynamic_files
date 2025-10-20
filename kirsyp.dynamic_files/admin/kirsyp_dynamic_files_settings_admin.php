<?php

/** @var CMain $APPLICATION */
/** @var CDatabase $DB */

/** @var CUser $USER */

use Bitrix\Main\Config\Option;
use Bitrix\Main\Application;
use Bitrix\Crm\Service\Container;
use Bitrix\Main\Loader;
use Bitrix\Main\UserFieldTable;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$APPLICATION->SetTitle("Настройки");

$moduleId = "kirsyp.dynamic_files";
if (!$USER->IsAdmin()) {
    $APPLICATION->AuthForm("Доступ запрещен");
}

// Подключаем модули
Loader::includeModule('crm');
$idStageDeal = '';
// Обработка сохранения формы
$request = Application::getInstance()->getContext()->getRequest();
if ($request->isPost() && check_bitrix_sessid()) {
    // Сохраняем значения
    Option::set($moduleId, 'deal_category_id_dynamic_list', $request->getPost('deal_category_id_dynamic_list'));

    // Сообщение об успешном сохранении
    CAdminMessage::ShowMessage([
        "MESSAGE" => "Настройки успешно сохранены",
        "TYPE" => "OK"
    ]);
}

// Получение текущих значений
$dealCategoryIdDynamicList = Option::get($moduleId, 'deal_category_id_dynamic_list', '');

$dealFunnel = [];

// Получить воронки
$stages = \Bitrix\Crm\Category\DealCategory::getAll(true, ['SORT' => 'ASC']);
$options = [];
foreach ($stages as $stage) {
    $dealFunnel[] = [
        'ID' => $stage['ID'],
        'NAME' => $stage['NAME'],
    ];
}

// Получение данных для формы
$container = Container::getInstance();
$typeDataClass = $container->getDynamicTypeDataClass(); // Смарт-процессы
$listDynamicTypes = $typeDataClass::getList([
    'select' => ['*']
])->fetchAll();

// Пользовательские поля сделки
$userTypeEntity = new \CUserTypeEntity();
$dbRes = $userTypeEntity->GetList([], ['ENTITY_ID' => 'CRM_DEAL']);
$ufDealFields = [];
while ($field = $dbRes->Fetch()) {
    $res = UserFieldTable::getFieldData($field['ID']);
    $field['name'] = $res['EDIT_FORM_LABEL']['ru'];
    $ufDealFields[] = $field;
}


// Заголовок страницы
$APPLICATION->SetTitle("Настройки модуля");

// Подключение пролога административной страницы
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
?>

    <form method="POST" action="<?= $APPLICATION->GetCurPage() ?>">
        <?= bitrix_sessid_post() ?>

        <!-- Динамические файлы -->
        <div class="fieldsunit">
            <label>Динамические файлы:</label>
        </div>
        <label for="deal_category_id_dynamic_list">Воронка для динамических файлов: </label>
        <select name="deal_category_id_dynamic_list" id="deal_category_id_dynamic_list">
            <option value="" <?= $dealCategoryIdDynamicList == '' ? 'selected' : '' ?>>Нет</option>
            <?php foreach ($dealFunnel as $funnel): ?>
                <option value="<?= $funnel['ID'] ?>" <?= $dealCategoryIdDynamicList == $funnel['ID'] ? 'selected' : '' ?>>
                    <?= $funnel['NAME'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    


        <input type="submit" value="Сохранить настройки">
    </form>

    <style>
        form {
            padding: 15px;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 7px 7px 20px -6px #7091AA33;
        }
    </style>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php"); ?>