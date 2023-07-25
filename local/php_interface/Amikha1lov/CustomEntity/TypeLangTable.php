<?php
namespace Amikha1lov\CustomEntity;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\Relations\Reference,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class TypeLangTable
 *
 * Fields:
 * <ul>
 * <li> IBLOCK_TYPE_ID string(50) mandatory
 * <li> LID string(2) mandatory
 * <li> NAME string(100) mandatory
 * <li> SECTION_NAME string(100) optional
 * <li> ELEMENT_NAME string(100) optional
 * <li> IBLOCK_TYPE_ID reference to {@link \Bitrix\Iblock\IblockTypeTable}
 * </ul>
 *
 * @package Bitrix\Iblock
 **/

class TypeLangTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_iblock_type_lang';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new StringField(
                'IBLOCK_TYPE_ID',
                [
                    'primary' => true,
                    'required' => true,
                    'validation' => [__CLASS__, 'validateIblockTypeId'],
                    'title' => Loc::getMessage('TYPE_LANG_ENTITY_IBLOCK_TYPE_ID_FIELD')
                ]
            ),
            new StringField(
                'LID',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateLid'],
                    'title' => Loc::getMessage('TYPE_LANG_ENTITY_LID_FIELD')
                ]
            ),
            new StringField(
                'NAME',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateName'],
                    'title' => Loc::getMessage('TYPE_LANG_ENTITY_NAME_FIELD')
                ]
            ),
            new StringField(
                'SECTION_NAME',
                [
                    'validation' => [__CLASS__, 'validateSectionName'],
                    'title' => Loc::getMessage('TYPE_LANG_ENTITY_SECTION_NAME_FIELD')
                ]
            ),
            new StringField(
                'ELEMENT_NAME',
                [
                    'validation' => [__CLASS__, 'validateElementName'],
                    'title' => Loc::getMessage('TYPE_LANG_ENTITY_ELEMENT_NAME_FIELD')
                ]
            ),
            new Reference(
                'IBLOCK_TYPE',
                '\Bitrix\Iblock\IblockType',
                ['=this.IBLOCK_TYPE_ID' => 'ref.ID'],
                ['join_type' => 'LEFT']
            ),
        ];
    }

    /**
     * Returns validators for IBLOCK_TYPE_ID field.
     *
     * @return array
     */
    public static function validateIblockTypeId()
    {
        return [
            new LengthValidator(null, 50),
        ];
    }

    /**
     * Returns validators for LID field.
     *
     * @return array
     */
    public static function validateLid()
    {
        return [
            new LengthValidator(null, 2),
        ];
    }

    /**
     * Returns validators for NAME field.
     *
     * @return array
     */
    public static function validateName()
    {
        return [
            new LengthValidator(null, 100),
        ];
    }

    /**
     * Returns validators for SECTION_NAME field.
     *
     * @return array
     */
    public static function validateSectionName()
    {
        return [
            new LengthValidator(null, 100),
        ];
    }

    /**
     * Returns validators for ELEMENT_NAME field.
     *
     * @return array
     */
    public static function validateElementName()
    {
        return [
            new LengthValidator(null, 100),
        ];
    }
}