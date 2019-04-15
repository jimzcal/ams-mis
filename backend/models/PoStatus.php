<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "po_status".
 *
 * @property int $id
 * @property string $date
 * @property string $process
 * @property string $employee
 */
class PoStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'po_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['process', 'employee'], 'required'],
            [['date'], 'safe'],
            [['process', 'employee', 'po_no'], 'string', 'max' => 100],
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
            'po_no' => 'PO No.',
            'process' => 'Process',
            'employee' => 'Employee',
        ];
    }
}
