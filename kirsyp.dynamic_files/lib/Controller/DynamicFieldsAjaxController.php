<?php

namespace KirSyp\DynamicFiles\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Request;


use KirSyp\DynamicFiles\Service\DynamicFilesService;

class DynamicFilesAjaxController extends Controller
{
    private DynamicFilesService $DynamicFilesService;

    public function __construct(Request $request = null)
    {
        $this->DynamicFilesService = new DynamicFilesService();

        parent::__construct($request);
    }

    public function getDynamicFilesDataAction(): array
    {
        return $this->DynamicFilesService->getDynamicFilesData();
    }
}