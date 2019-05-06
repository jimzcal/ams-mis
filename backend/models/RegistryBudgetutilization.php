<?php

namespace backend\models;

use Yii;
use backend\models\Far6Projects;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "registry_budgetutilization".
 *
 * @property int $id
 * @property string $date_registry
 * @property string $burs_date
 * @property string $burs_no
 * @property string $burs_class
 * @property string $burs_year
 * @property string $burs_month
 * @property string $burs_serial
 * @property string $payee
 * @property string $operating_unit
 * @property string $fund_cluster
 * @property string $responsibility_center
 * @property string $particulars
 * @property string $mfo_pap
 * @property string $uacs
 * @property string $amount
 * @property int $project_id
 */
class RegistryBudgetutilization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registry_budgetutilization';
    }

    public $ids;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_registry', 'burs_date'], 'safe'],
            [['burs_date', 'burs_no', 'payee', 'operating_unit', 'fund_cluster', 'responsibility_center', 'particulars', 'mfo_pap', 'uacs', 'amount', 'project_id', 'appropriation_type'], 'required'],
            [['particulars'], 'string'],
            [['amount'], 'number'],
            [['project_id', 'ids'], 'integer'],
            [['burs_no', 'burs_class', 'burs_year', 'burs_month', 'burs_serial', 'payee', 'operating_unit', 'fund_cluster', 'responsibility_center', 'mfo_pap', 'uacs', 'appropriation_type'], 'string', 'max' => 100],
        ];
    }

    public function getProjecttitle($project_id)
    {
        $data = Far6Projects::find()->where(['id' => $project_id])->one();

        return $data->project_title;
    }

    public function getSum($burs_no, $project_id, $operating_unit)
    {
        $sum_amount = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['burs_no' => $burs_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->all(), 'amount'));
        
        return $sum_amount;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_registry' => 'Date Registry',
            'burs_date' => 'BURS Date',
            'burs_no' => 'BURS No.',
            'burs_class' => 'BURS Class',
            'burs_year' => 'BURS Year',
            'burs_month' => 'BURS Month',
            'burs_serial' => 'BURS Serial',
            'appropriation_type' =>  'Appropriation Type',
            'payee' => 'Payee',
            'operating_unit' => 'Operating Unit',
            'fund_cluster' => 'Fund Cluster',
            'responsibility_center' => 'Responsibility Center',
            'particulars' => 'Particulars',
            'mfo_pap' => 'MFO PAP',
            'uacs' => 'UACS',
            'amount' => 'Amount',
            'project_id' => 'Project',
        ];
    }
}
