<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dv_remarks".
 *
 * @property int $id
 * @property string $date
 * @property string $region
 * @property string $dv_no
 * @property string $fullname
 * @property string $remarks
 */
class DvRemarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dv_remarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['region', 'dv_no', 'fullname', 'remarks'], 'required'],
            [['remarks'], 'string'],
            [['region', 'dv_no', 'fullname'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'region' => 'Region',
            'dv_no' => 'Dv No',
            'fullname' => 'Fullname',
            'remarks' => 'Remarks',
        ];
    }
}
