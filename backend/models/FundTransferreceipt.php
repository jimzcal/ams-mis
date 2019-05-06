<?php

namespace backend\models;

use Yii;
use backend\models\Far6Projects;

/**
 * This is the model class for table "fund_transferreceipt".
 *
 * @property int $id
 * @property string $date_entry
 * @property string $operating_unit
 * @property int $project_id
 * @property string $date_fundreceipt
 * @property string $reference
 * @property string $department
 * @property string $agency
 * @property string $operating_office
 * @property string $amount
 */
class FundTransferreceipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fund_transferreceipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'date_fundreceipt', 'operating_office'], 'safe'],
            [['operating_unit', 'project_id', 'date_fundreceipt', 'reference', 'department', 'agency', 'amount', 'type'], 'required'],
            [['project_id'], 'integer'],
            [['amount'], 'number'],
            [['operating_unit', 'reference', 'department', 'agency', 'operating_office', 'type'], 'string', 'max' => 100],
        ];
    }

    public function getProject()
    {
        $data =  Far6Projects::find()->where(['id' => $this->project_id])->one();

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
            'operating_unit' => 'Operating Unit',
            'project_id' => 'Project Title',
            'date_fundreceipt' => 'Date Fund Receipt',
            'reference' => 'Reference',
            'department' => 'Department',
            'type' => 'Type',
            'agency' => 'Agency',
            'operating_office' => 'Operating Office',
            'amount' => 'Amount',
        ];
    }
}
