<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("maps");
?>

<?php $APPLICATION->IncludeComponent(
    "amikha1lov:ymaps",
    "",
    array()
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>