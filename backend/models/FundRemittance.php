<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fund_remittance".
 *
 * @property int $id
 * @property string $date_entry
 * @property int $project_id
 * @property string $operating_unit
 * @property string $btr_date
 * @property string $btr_amount
 * @property string $ncarequest_date
 * @property string $ncarequest_amount
 * @property string $nca_date
 * @property string $nca_amount
 * @property string $nca_reference
 */
class FundRemittance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fund_remittance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'btr_date', 'ncarequest_date', 'nca_date', 'ncarequest_amount', 'nca_amount', 'nca_reference'], 'safe'],
            [['project_id', 'operating_unit', 'btr_date', 'btr_amount'], 'required'],
            [['project_id'], 'integer'],
            [['btr_amount', 'ncarequest_amount', 'nca_amount'], 'number'],
            [['operating_unit'], 'string', 'max' => 100],
            [['nca_reference'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'project_id' => 'Project',
            'operating_unit' => 'Operating Unit',
            'btr_date' => 'BTR Date',
            'btr_amount' => 'BTR Amount',
            'ncarequest_date' => 'NCA Request Date',
            'ncarequest_amount' => 'NCA Request Amount',
            'nca_date' => 'NCA Date',
            'nca_amount' => 'NCA Amount',
            'nca_reference' => 'NCA Reference',
        ];
    }
}
