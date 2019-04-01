<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "liquidation".
 *
 * @property int $id
 * @property string $date
 * @property int $project_id
 * @property string $region
 * @property string $sub_office
 * @property string $ors_no
 * @property string $ors_class
 * @property string $funding_source
 * @property string $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $rc
 * @property string $object_code
 * @property string $amount
 * @property string $status
 */
class Liquidation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liquidation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'project_id', 'region', 'sub_office', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'amount', 'status'], 'required'],
            [['date'], 'safe'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['region', 'sub_office', 'ors_no', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'status'], 'string', 'max' => 100],
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
            'project_id' => 'Project ID',
            'region' => 'Region',
            'sub_office' => 'Sub Office',
            'ors_no' => 'Ors No',
            'ors_class' => 'Ors Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'rc' => 'Rc',
            'object_code' => 'Object Code',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }
}
