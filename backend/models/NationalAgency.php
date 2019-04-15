<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "national_agency".
 *
 * @property int $id
 * @property string $department
 * @property string $egency
 * @property string $operating_unit
 * @property string $organization_code
 */
class NationalAgency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'national_agency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department'], 'required'],
            [['department', 'agency', 'operating_unit', 'organization_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'agency' => 'Agency',
            'operating_unit' => 'Operating Unit',
            'organization_code' => 'Organization Code',
        ];
    }
}
