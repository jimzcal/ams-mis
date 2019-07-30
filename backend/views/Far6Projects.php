<?php

namespace backend\models;

use Yii;
use backend\models\RegistryBudgetutilization;
use yii\helpers\ArrayHelper;
use backend\models\FundTransferreceipt;
use backend\models\BursDisbursement;
use backend\models\BursLiquidation;
use backend\models\OperatingUnit;

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

    public $fund_cluster, $appropriation_type, $burs_year, $year_receipt;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry', 'date_approved',  'operating_office'], 'safe'],
            [['operating_unit', 'department', 'agency', 'project_title', 'date_approved', 'approved_budget', 'status', 'uacs', 'type'], 'required'],
            [['approved_budget', 'fund_cluster', 'burs_year', 'year_receipt'], 'number'],
            [['operating_unit', 'department', 'agency', 'operating_office', 'status', 'uacs', 'appropriation_type', 'type'], 'string', 'max' => 100],
            [['project_title'], 'string', 'max' => 250],
        ];
    }

    public function getAgency($department, $operating_unit, $type)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                    ->andWhere(['operating_unit' => $operating_unit])
                                    ->andWhere(['type' => $type])
                                    ->groupBy(['agency'])
                                    ->all();

        return $data;
    }

    public function getOu($department, $agency, $operating_unit, $type)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->andWhere(['type' => $type])
                                ->groupBy(['operating_office'])
                                ->all();
        return $data;
    }

    public function getProjects($department, $agency, $operating_unit, $operating_office, $type)
    {
        $data = Far6Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->andWhere(['operating_office' => $operating_office])
                                ->andWhere(['type' => $type])
                                ->all();

        return $data;
    }

    public function getProject($operating_unit, $type)
    {
        $data = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['type' => $type])
                                    ->andWhere(['status' => 'Active'])
                                    ->all();

        return $data;
    }

    public function getProject2($operating_unit, $type)
    {
        $data = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['type' => $type])
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

    public function getConsolbudget($operating_unit, $type)
    {
        $approved_budget = [];

        if($type != 'All')
        {
            $projects = Far6Projects::find()->where(['type' => $type])
                                        ->andWhere(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            foreach ($projects as $key => $value) 
            {
                $budget = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                                ->where(['operating_unit' => $operating_unit])
                                ->andWhere(['type' => 'Approved Budget'])
                                ->andWhere(['project_id' => $value->id])
                                ->all(), 'amount'));

                array_push($approved_budget, $budget);
            }
        }

        else
        {
            $projects = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            foreach ($projects as $key => $value) 
            {
                $budget = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                                ->where(['operating_unit' => $operating_unit])
                                ->andWhere(['type' => 'Approved Budget'])
                                ->andWhere(['project_id' => $value->id])
                                ->all(), 'amount'));

                array_push($approved_budget, $budget);
            }
        }

        return array_sum($approved_budget);
    }

    public function getBudgetadjustments($project_id)
    {
        $Adjustments = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['type' => 'Adjustments'])
                            ->all(), 'amount'));

        return $Adjustments;
    }

    public function getConsolbudadjust($operating_unit, $type)
    {
        $adjusted_budget = [];

        if($type != 'All')
        {
            $projects = Far6Projects::find()->where(['type' => $type])
                                        ->andWhere(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            foreach ($projects as $key => $value) 
            {
                $budget = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                                ->where(['operating_unit' => $operating_unit])
                                ->andWhere(['type' => 'Adjustments'])
                                ->andWhere(['project_id' => $value->id])
                                ->all(), 'amount'));

                array_push($adjusted_budget, $budget);
            }
        }

        else
        {
            $projects = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            foreach ($projects as $key => $value) 
            {
                $budget = array_sum(ArrayHelper::getColumn(FundTransferreceipt::find()
                                ->where(['operating_unit' => $operating_unit])
                                ->andWhere(['type' => 'Adjustments'])
                                ->andWhere(['project_id' => $value->id])
                                ->all(), 'amount'));

                array_push($adjusted_budget, $budget);
            }
        }

        return array_sum($adjusted_budget);
    }

    public function getConsolUtilization($operating_unit, $type, $burs_year)
    {
        $approved_budget = [];

        if($type != 'All')
        {
            $projects = Far6Projects::find()->where(['type' => $type])
                                        ->andWhere(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            if($burs_year != 'All')
            {
                foreach ($projects as $key => $value) 
                {
                    $budget = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($approved_budget, $budget);
                }
            }

            else
            {
                foreach ($projects as $key => $value) 
                {
                    $budget = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    //->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($approved_budget, $budget);
                }
            }
            
        }

        else
        {
            $projects = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            if($burs_year != 'All')
            {
                foreach ($projects as $key => $value) 
                {
                    $budget = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($approved_budget, $budget);
                }
            }

            else
            {
                foreach ($projects as $key => $value) 
                {
                    $budget = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    //->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($approved_budget, $budget);
                }
            }
        }

        return array_sum($approved_budget);
    }

    public function getConsolDisbursement($operating_unit, $type, $burs_year)
    {
        $total_disbursement = [];

        if($type != 'All')
        {
            $projects = Far6Projects::find()->where(['type' => $type])
                                        ->andWhere(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            if($burs_year != 'All')
            {
                foreach ($projects as $key => $value) 
                {
                    $disbursement = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($total_disbursement, $disbursement);
                }
            }

            else
            {
                foreach ($projects as $key => $value) 
                {
                    $disbursement = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    //->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($total_disbursement, $disbursement);
                }
            }
            
        }

        else
        {
            $projects = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                        ->andWhere(['status' => 'Active'])
                                        ->all();

            if($burs_year != 'All')
            {
                foreach ($projects as $key => $value) 
                {
                    $disbursement = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    ->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($total_disbursement, $disbursement);
                }
            }

            else
            {
                foreach ($projects as $key => $value) 
                {
                    $disbursement = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                                    ->where(['operating_unit' => $operating_unit])
                                    //->andWhere(['burs_year' => $burs_year])
                                    ->andWhere(['project_id' => $value->id])
                                    ->all(), 'amount'));

                    array_push($total_disbursement, $disbursement);
                }
            }
        }

        return array_sum($total_disbursement);
    }

    public function getDue($project_id)
    {
        $due = array_sum(ArrayHelper::getColumn(DueDemandables::find()
                            ->where(['project_id' => $project_id])
                            //->andWhere(['type' => 'Adjustments'])
                            ->all(), 'amount'));
        return $due;
    }

    public function getUtilization($project_id, $quarter, $burs_year)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-01-01'), date($burs_year.'-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-04-01'), date($burs_year.'-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-07-01'), date($burs_year.'-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-10-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-01-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getCheckreceived($project_id, $year_receipt)
    {
        $data = FundTransferreceipt::find()->where(['project_id' => $project_id])
                                            ->andWhere(['like', 'date_fundreceipt', $year_receipt])
                                            ->one();

        return $data;
    }

    public function getUtilization2($project_id, $expense_class, $quarter, $burs_year)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-01-01'), date($burs_year.'-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-04-01'), date($burs_year.'-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-07-01'), date($burs_year.'-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-10-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'burs_date', date($burs_year.'-01-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getDisbursement($project_id, $quarter, $burs_year)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-01-01'), date($burs_year.'-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-04-01'), date($burs_year.'-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-07-01'), date($burs_year.'-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-10-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-01-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getDisbursement2($project_id, $expense_class, $quarter, $burs_year)
    {
        if($quarter == 1)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-01-01'), date($burs_year.'-03-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 2)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-04-01'), date($burs_year.'-06-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 3)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-07-01'), date($burs_year.'-09-30')])
                            ->all(), 'amount'));
        }

        if($quarter == 4)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-10-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }

        if($quarter == 5)
        {
            return $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                            ->where(['project_id' => $project_id])
                            ->andWhere(['burs_class' => $expense_class])
                            ->andWhere(['burs_year' => $burs_year])
                            ->andWhere(['between', 'dv_date', date($burs_year.'-01-01'), date($burs_year.'-12-31')])
                            ->all(), 'amount'));
        }
    }

    public function getCheckproject($project_id, $appropriation_type)
    {
        $data = RegistryBudgetutilization::find()->where(['project_id' => $project_id])
                                    ->andWhere(['appropriation_type' => $appropriation_type])
                                    //->andWhere(['burs_year' => date('Y')])
                                    ->one();

        return $data;
    }

    public function getCheckproject2($project_id)
    {
        $data = RegistryBudgetutilization::find()->where(['project_id' => $project_id])
                                    //->andWhere(['appropriation_type' => $appropriation_type])
                                    ->andWhere(['burs_year' => date('Y')])
                                    ->all();

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

    public function getCheckagency2($department, $agency, $type, $year_receipt, $operating_unit)
    {
        $check_data = 0;

        $data = Far6Projects::find()->where(['agency' => $agency])
                                ->andWhere(['department' => $department])
                                ->andWhere(['type' => $type])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = FundTransferreceipt::find()->where(['project_id' => $value->id])
                                        ->andWhere(['like', 'date_fundreceipt', $year_receipt])
                                        ->andWhere(['operating_unit' => $operating_unit])
                                        ->one();

            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getCheckdata($operating_unit, $type)
    {
        return $data = Far6Projects::find()->where(['operating_unit' => $operating_unit])
                                        ->andWhere(['type' => $type])
                                        ->andWhere(['status' => 'Active'])
                                        ->one();
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

    public function getCheckdepartment2($department, $year_receipt, $operating_unit)
    {
        $check_data = 0;

        $data = Far6Projects::find()->where(['department' => $department])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = FundTransferreceipt::find()
                            ->where(['project_id' => $value->id])
                            ->andFilterWhere(['like', 'date_fundreceipt', $year_receipt])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->one();

            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getMonthlydisbursement($project_id)
    {
        $monthly_disbursement = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(BursDisbursement::find()
                    ->where(['project_id' => $project_id])
                    ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                    ->andFilterWhere(['like', 'dv_date', date('Y-m', $date)])
                    ->all(), 'amount'));

            array_push($monthly_disbursement, $data);

            $date = strtotime( "+1 month", $date);
        }

        return $monthly_disbursement;
        
    }

    public function getMonthlyutilization($project_id)
    {
        $monthly_utilization = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(RegistryBudgetutilization::find()
                    ->where(['project_id' => $project_id])
                    ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                    ->andFilterWhere(['like', 'burs_date', date('Y-m', $date)])
                    ->all(), 'amount'));

            array_push($monthly_utilization, $data);

            $date = strtotime( "+1 month", $date);
        }

        return $monthly_utilization;
        
    }

    public function getOperating()
    {
        return $data = OperatingUnit::find()->where(['abbreviation' => $this->operating_unit])->one();
    }

    public function getMonthlyliquidation($project_id)
    {
        $monthly_liquidation = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(BursLiquidation::find()
                    ->where(['project_id' => $project_id])
                    ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                    ->andFilterWhere(['like', 'liquidation_date', date('Y-m', $date)])
                    ->all(), 'amount'));

            array_push($monthly_liquidation, $data);

            $date = strtotime( "+1 month", $date);
        }

        return $monthly_liquidation;
        
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
            'approved_budget' => 'Budget',
            'status' => 'Status',
        ];
    }
}
