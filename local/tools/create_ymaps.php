<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
session_start();

use Amikha1lov\IblockElementService;
use Amikha1lov\IblockService;

$iblockService = new IblockService([
    'ID' => 'ymaps',
    'SECTIONS' => 'N',
    'NAME' => 'Яндекс карты',
    'LANG' => [
        'ru' => 'Карты',
        'en' => 'Maps',
    ]
]);

$iblockId = $iblockService->createIblock()->getId();

if($iblockId){
    $_SESSION['iblock'] = $iblockId;

    $iblockElementService = new IblockElementService($iblockId);

    $iblockElementService->addProperties([
        [
            "NAME" => 'Телефон',
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "PHONE",
            "PROPERTY_TYPE" => "S",
        ],
        [
            "NAME" => 'Email',
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "EMAIL",
            "PROPERTY_TYPE" => "S",
        ],
        [
            "NAME" => 'Координаты',
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "COORDS",
            "PROPERTY_TYPE" => "S",
        ],
        [
            "NAME" => 'Город',
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "CITY",
            "PROPERTY_TYPE" => "S",
        ]

    ]);

    $iblockElementService->addElements([
        [
            'NAME' => 'Офис №1',
            'PROPERTIES' => [
                'PHONE' => '+79991112233',
                'EMAIL' => 'mail3@mail.com',
                'COORD_X' => '37.618876',
                'COORD_Y' => '55.751428',
                'CITY' => 'Москва'
            ]
        ],
        [
            'NAME' => 'Офис №2',
            'PROPERTIES' => [
                'PHONE' => '+79991112222',
                'EMAIL' => 'mail2@mail.com',
                'COORD_X' => '37.573148',
                'COORD_Y' => '55.754972',
                'CITY' => 'Москва'
            ]
        ],
        [
            'NAME' => 'Офис №3',
            'PROPERTIES' => [
                'PHONE' => '+79991112211',
                'EMAIL' => 'mail3@mail.com',
                'COORD_X' => '37.618574',
                'COORD_Y' => '55.760178',
                'CITY' => 'Москва'
            ]
        ]
    ]);

};
