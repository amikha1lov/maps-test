<?php

namespace Amikha1lov;

use Amikha1lov\CustomEntity\TypeLangTable;
use Amikha1lov\CustomEntity\TypeTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Query\Query;

class IblockService
{

    public string $iblockId;

    protected array $data;

    public function __construct(array $data)
    {
        Loader::includeModule("iblock");

        $this->data = $data;
        $this->iblockId = $this->data['ID'];
    }

    public function createIblock()
    {

        if (!$this->isIblockTypeExists()) {

            $this->createIblockType();
            $this->addTypeLang();


            $iblock = IblockTable::add([
                'NAME' => $this->data['LANG']['ru'],
                'IBLOCK_TYPE_ID' => $this->data['ID'],
                'LID' => $this->getSiteId(),
            ]);
            echo '>>> Инфоблок успешно создан';
            return $iblock;

        } else {
            throw new \Exception('Невозможно создать инфоблок. Данный инфоблок уже существует');
        }


    }

    protected function isIblockTypeExists()
    {

        $query = new Query(
            TypeTable::getEntity()
        );

        $res = $query
            ->setFilter([
                'ID' => $this->iblockId
            ])
            ->exec()
            ->fetchObject();

        return (bool)$res;

    }

    protected function createIblockType()
    {
        $iblockType = TypeTable::add([
            'ID' => $this->data['ID'],
            'SECTIONS' => $this->data['SECTIONS']
        ]);

        return $iblockType->getId();
    }

    protected function addTypeLang()
    {

        foreach ($this->data['LANG'] as $key => $value) {
            TypeLangTable::add([
                'IBLOCK_TYPE_ID' => $this->iblockId,
                'LID' => $key,
                'NAME' => $value,
            ]);
        }
    }

    protected function getSiteId()
    {
        $context = Application::getInstance()->getContext();

        return $context->getSite();
    }
}