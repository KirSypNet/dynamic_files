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

    public function getContractsByContractorIdAction($clientInfo, $filterProps): array
    {
        return $this->DynamicFilesService->getContractsByContractorId($clientInfo, $filterProps);
    }

    public function getContractorEmailsAction($clientInfo): array
    {
        return $this->DynamicFilesService->getContractorEmails($clientInfo);
    }

    public function addContractorNewEmailAction($contractorId, $contractorType, $email): array
    {
        return $this->DynamicFilesService->addContractorNewEmail($contractorId, $contractorType, $email);
    }

    public function getInsuranceDataAction($insuranceProductItemId, $insuranceDirectionSectionId, $businessDirectionSectionId, $categoryId)
    {
        return $this->DynamicFilesService->getInsuranceData($insuranceProductItemId, $insuranceDirectionSectionId, $businessDirectionSectionId, $categoryId);
    }

    public function getInsuranceDataV2Action($businessDirection, $insuranceDirection, $insuranceProduct, $categoryID)
    {
        return $this->DynamicFilesService->getInsuranceDataV2($businessDirection, $insuranceDirection, $insuranceProduct, $categoryID);
    }
}