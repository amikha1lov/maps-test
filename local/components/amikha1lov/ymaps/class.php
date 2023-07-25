<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Amikha1lov\CacheHelper;
use Amikha1lov\IblockElementService;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

class YMapsComponent extends CBitrixComponent
{

    public function executeComponent()
    {
        try {
            $this->prepareData();
            $this->includeComponentTemplate();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }


    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    protected function prepareData()
    {
        $cachePath = 'ymaps';

        $cache = new CacheHelper(
            $cachePath,
            3600,
            '648c3f13deb4f-648c3f1ef2b52-648c3f2530932');

        $cacheTag = $cachePath;


        $data = $cache->setTag($cacheTag)->callback(function (){

            $iblockElementService = new IblockElementService($_SESSION['iblock']);

            return $iblockElementService->getElements();
        });


        if (!$data) {
            throw new SystemException('Данные не найдены');
        }

        $this->arResult['DATA'] = $data;

    }

    public function onPrepareComponentParams($arParams): array
    {
        if (!isset($arParams['CACHE_TIME'])) {
            $arParams['CACHE_TIME'] = 3600;
        } else {
            $arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']);
        }

        return $arParams;
    }
}
