<?php

namespace backend\models;

use Yii;
use backend\models\NationalAgency;

/**
 * This is the model class for table "implementing_agency".
 *
 * @property int $id
 * @property string $national_agency
 * @property string $uacs
 * @property string $implementing_agency
 */
class ImplementingAgency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'implementing_agency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['national_agency', 'uacs', 'implementing_agency'], 'required'],
            [['national_agency', 'uacs', 'implementing_agency'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'national_agency' => 'National Agency',
            'uacs' => 'UACS',
            'implementing_agency' => 'Implementing Agency',
        ];
    }

    public function getNational()
    {
        $data = NationalAgency::find()->where(['id' => $this->national_agency])->one();

        return $data;
    }
}
