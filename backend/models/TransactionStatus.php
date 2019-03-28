<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaction_status".
 *
 * @property int $id
 * @property string $region
 * @property string $dv_no
 * @property string $date
 * @property string $process
 * @property string $employee
 */
class TransactionStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region', 'dv_no', 'process', 'employee'], 'required'],
            [['date'], 'safe'],
            [['region', 'dv_no', 'process', 'employee'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'dv_no' => 'Dv No',
            'date' => 'Date',
            'process' => 'Process',
            'employee' => 'Employee',
        ];
    }
}
