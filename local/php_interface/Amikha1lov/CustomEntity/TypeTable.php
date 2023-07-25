<?php
namespace Amikha1lov\CustomEntity;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\BooleanField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class TypeTable
 *
 * Fields:
 * <ul>
 * <li> ID string(50) mandatory
 * <li> SECTIONS bool ('N', 'Y') optional default 'Y'
 * <li> EDIT_FILE_BEFORE string(255) optional
 * <li> EDIT_FILE_AFTER string(255) optional
 * <li> IN_RSS bool ('N', 'Y') optional default 'N'
 * <li> SORT int optional default 500
 * </ul>
 *
 * @package Bitrix\Iblock
 **/

class TypeTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_iblock_type';
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
                'ID',
                [
                    'primary' => true,
                    'validation' => [__CLASS__, 'validateId'],
                    'title' => Loc::getMessage('TYPE_ENTITY_ID_FIELD')
                ]
            ),
            new BooleanField(
                'SECTIONS',
                [
                    'values' => array('N', 'Y'),
                    'default' => 'Y',
                    'title' => Loc::getMessage('TYPE_ENTITY_SECTIONS_FIELD')
                ]
            ),
            new StringField(
                'EDIT_FILE_BEFORE',
                [
                    'validation' => [__CLASS__, 'validateEditFileBefore'],
                    'title' => Loc::getMessage('TYPE_ENTITY_EDIT_FILE_BEFORE_FIELD')
                ]
            ),
            new StringField(
                'EDIT_FILE_AFTER',
                [
                    'validation' => [__CLASS__, 'validateEditFileAfter'],
                    'title' => Loc::getMessage('TYPE_ENTITY_EDIT_FILE_AFTER_FIELD')
                ]
            ),
            new BooleanField(
                'IN_RSS',
                [
                    'values' => array('N', 'Y'),
                    'default' => 'N',
                    'title' => Loc::getMessage('TYPE_ENTITY_IN_RSS_FIELD')
                ]
            ),
            new IntegerField(
                'SORT',
                [
                    'default' => 500,
                    'title' => Loc::getMessage('TYPE_ENTITY_SORT_FIELD')
                ]
            ),
        ];
    }

    /**
     * Returns validators for ID field.
     *
     * @return array
     */
    public static function validateId()
    {
        return [
            new LengthValidator(null, 50),
        ];
    }

    /**
     * Returns validators for EDIT_FILE_BEFORE field.
     *
     * @return array
     */
    public static function validateEditFileBefore()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for EDIT_FILE_AFTER field.
     *
     * @return array
     */
    public static function validateEditFileAfter()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}