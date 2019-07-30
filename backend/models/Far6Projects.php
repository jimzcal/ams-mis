<?php

namespace backend\models;

use Yii;
use backend\models\RegistryBudgetutilization;
use yii\helpers\ArrayHelper;
use backend\models\FundTransferreceipt;
use backend\models\BursDisbursement;

/**
 * This is the model class for table "far6_projects".
 *
 * @property int $id
 * @property string $date_entry
 * @property string $operating_unit
 * @property string $department
 * @property string $agency
 * @property string $operating_office
 * @property string $project_title
 * @property string $date_approved
 * @property string $approved_budget
 */
class Far6Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'far6_projects';
    }

    public $fund_cluster, $appropriation_type;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'date_approved',  'operating_office'], 'safe'],
            [['operating_unit', 'department', 'agency', 'project_title', 'date_approved', 'approved_budget', 'status', 'uacs', 'type'], 'required'],
            [['approved_budget', 'fund_cluster'], 'number'],
            [['operating_unit', 'department', 'agency', 'operating_office', 'project_title', 'status', 'uacs', 'appropriation_type', 'type'], 'string', 'max' => 100],
        ];
    }

    public function getAgency($department, $operating_unit)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                    ->andWhere(['operating_unit' => $operating_unit])
                                    ->groupBy(['agency'])
                                    ->all();

        return $data;
    }

    public function getOu($department, $agency, $operating_unit)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->groupBy(['operating_office'])
                                ->all();
        return $data;
    }

    public function getProjects($department, $agency, $operating_unit, $operating_office)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->andWhere(['operating_office' => $operating_office])
                                ->all();

        return $data;
    }

    public function getProject($operating_unit)
    {
        $data = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['status' => 'Active'])
                                    ->all();

        return $data;
    }

    public function getBudget($project_id)
    {
        $budget = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['type' => 'Approved Budget'])
                            ->all(), 'amount'));

        return $budget;
    }

    public function getBudgetadjustments($project_id)
    {
        $Adjustments = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['type' => 'Adjustments'])
                            ->all(), 'amount'));

        return $Adjustments;
    }

    public function getUtilization($project_id, $quarter)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-04-01'), date('Y-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-07-01'), date('Y-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-10-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getUtilization2($project_id, $expense_class, $quarter)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-04-01'), date('Y-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-07-01'), date('Y-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-10-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getDisbursement($project_id, $quarter)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-04-01'), date('Y-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-07-01'), date('Y-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-10-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getDisbursement2($project_id, $expense_class, $quarter)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-04-01'), date('Y-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-07-01'), date('Y-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-10-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['between', 'burs_date', date('Y-01-01'), date('Y-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getCheckproject($project_id, $appropriation_type)
    {
        $data = RegistryBudgetutilization::find()->where(['project_id' => $project_id])
                                    ->andWhere(['appropriation_type' => $appropriation_type])
                                    ->one();

        return $data;
    }

    public function getCheckagency($agency, $appropriation_type)
    {
        $check_data = 0;

        $data = RegistryBudgetutilization::find()->where(['agency' => $agency])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = RegistryBudgetutilization::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_type' => $appropriation_type])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : 0;
        }

        return $check_data;
    }

    public function getCheckdata($operating_unit)
    {
        return $data = Far6Projects::find()->where(['operating_unit' => $operating_unit])->one();
    }

    public function getCheckdepartment($department, $appropriation_type)
    {
        $check_data = 0;

        $data = RegistryBudgetutilization::find()->where(['department' => $department])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = RegistryBudgetutilization::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_type' => $appropriation_type])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : 0;
        }

        return $check_data;
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
            'department' => 'Department',
            'agency' => 'Agency',
            'uacs' => 'UACS',
            'type' => 'Project Type',
            'operating_office' => 'Operating Office',
            'project_title' => 'Project Title',
            'date_approved' => 'Date Approved',
            'approved_budget' => 'Approved Budget',
            'status' => 'Status',
        ];
    }
}
