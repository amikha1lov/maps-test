<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?apikey=9160c851-13c3-4efd-bdd0-7499f4d180e1&lang=ru_RU");
?>


<div class="container ymaps-component">

    <div class="ymaps-component__wrapper">
        <ul class="ymaps-component__list">
            <? foreach ($arResult['DATA'] as $datum):?>
                <li class="ymaps-component__item"
                    data-name="<?=$datum['NAME']?>"
                    data-coords="<?=$datum['PROPERTIES']['COORDS']?>"
                    data-email="<?=$datum['PROPERTIES']['EMAIL']?>"
                    data-sity="<?=$datum['PROPERTIES']['CITY']?>"
                >
                    <?=$datum['NAME']?>
                </li>
            <? endforeach;?>
        </ul>
    </div>

    <div id="map"></div>
</div>


