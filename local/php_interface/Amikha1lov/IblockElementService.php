<?php

namespace Amikha1lov;

use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Query\Query;

class IblockElementService
{
    protected int $iblockId;

    public function __construct(int $id)
    {
        Loader::includeModule("iblock");

        $this->iblockId = $id;
    }

    public function addElements(array $elements)
    {

        foreach ($elements as $element) {

            $iblockElement = new \CIBlockElement;

            $properties = array();
            $properties['PHONE'] = $element['PROPERTIES']['PHONE'];
            $properties['EMAIL'] = $element['PROPERTIES']['EMAIL'];
            $properties['COORDS'] = $element['PROPERTIES']['COORD_X'] . "," . $element['PROPERTIES']['COORD_Y'];
            $properties['CITY'] = $element['PROPERTIES']['CITY'];

            $prepareData = array(
                "MODIFIED_BY" => 1,
                "IBLOCK_ID" => $this->iblockId,
                "PROPERTY_VALUES" => $properties,
                "NAME" => $element['NAME'],
                "ACTIVE" => "Y",
            );

            if (!$iblockElement->Add($prepareData)) {
                throw new \Exception('Не удалось добавить элемент');
            }
        }

        echo '>>>Элементы добавлены';


    }


    public function addProperties(array $properties)
    {

        $existProperties = $this->existProperties();

        foreach ($properties as $propertyList) {

            if (!in_array($propertyList['CODE'], $existProperties)) {
                $propertyList["IBLOCK_ID"] = $this->iblockId;
                $IblockProperty = new \CIBlockProperty;

                if (!$IblockProperty->Add($propertyList)) {
                    throw new \Exception('Не удалось добавить свойство');
                }

            } else {
                throw new \Exception('Свойства уже существуют');
            }

        }
        echo '>>>Свойства добавлены';

    }

    protected function existProperties()
    {
        $query = new Query(
            PropertyTable::getEntity()
        );

        $result = $query
            ->setFilter([
                'IBLOCK_ID' => $this->iblockId
            ])
            ->setSelect([
                'CODE'
            ])
            ->exec()
            ->fetchCollection();


        $properties = [];

        foreach ($result as $res) {
            $properties[] = $res['CODE'];
        }

        return $properties;

    }

    public function getElements()
    {
        $query = ElementTable::getList(array(
            "select" => array("ID", "NAME","IBLOCK_ID"),
            "filter" => array("IBLOCK_ID" => $this->iblockId),
            "order"  => array("ID" => "ASC"),
            "cache"  => array(
                'ttl' => 3600,
                'cache_joins' => true
            )
        ));

        $result = [];

        while ($element = $query->fetch()) {

            $propertiesQuery = \CIBlockElement::getProperty(
                $element['IBLOCK_ID'],
                $element['ID'], array("SORT", "ASC"),
                array()
            );
            $result[$element['ID']] = $element;
            while ($property = $propertiesQuery->GetNext()) {

                $result[$element['ID']]['PROPERTIES'][$property['CODE']] = $property['VALUE'];
            }

        }

        return $result;
    }


}