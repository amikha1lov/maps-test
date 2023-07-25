<?php

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\EventManager;

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/vendor/autoload.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/vendor/autoload.php");
}

AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("CacheReset", "OnAfterIBlockElementAddHandler"));

class CacheReset
{

    public static function OnAfterIBlockElementAddHandler(&$arFields)
    {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->ClearByTag('ymaps');;
    }
}