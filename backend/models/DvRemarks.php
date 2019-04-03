<?php

namespace backend\models;

use Yii;
use dektrium\user\models\User;

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
            [['region', 'dv_no', 'employee_id', 'remarks'], 'required'],
            [['remarks'], 'string'],
            [['region', 'dv_no', 'employee_id'], 'string', 'max' => 100],
        ];
    }

    public function getName()
    {
        $data = User::find()->where(['id' => $this->employee_id])->one();

        return $data;
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
            'employee_id' => 'Employee',
            'remarks' => 'Remarks',
        ];
    }
}
