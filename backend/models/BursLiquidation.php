<?php

namespace backend\models;

use Yii;
use backend\models\Far6Projects;
/**
 * This is the model class for table "burs_liquidation".
 *
 * @property int $id
 * @property string $date_entry
 * @property int $project_id
 * @property string $burs_no
 * @property string $burs_date
 * @property string $operating_unit
 * @property string $liquidation_date
 * @property string $amount
 * @property string $status
 */
class BursLiquidation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'burs_liquidation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'burs_date', 'liquidation_date'], 'safe'],
            [['project_id', 'burs_no', 'burs_date', 'operating_unit', 'liquidation_date', 'amount', 'status'], 'required'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['burs_no', 'operating_unit', 'status'], 'string', 'max' => 100],
        ];
    }

    public function getProjecttitle($project_id)
    {
        $data = Far6Projects::find()->where(['id' => $project_id])->one();

        return $data->project_title;
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
            'burs_no' => 'BURS No.',
            'burs_date' => 'BURS Date',
            'operating_unit' => 'Operating Unit',
            'liquidation_date' => 'Liquidation Date',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }
}
