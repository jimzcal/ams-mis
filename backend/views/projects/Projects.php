<?php

namespace backend\models;

use Yii;
use backend\models\JournalEntry;
use backend\models\OperatingUnit;
use yii\helpers\ArrayHelper;
use backend\models\Obligations;
use backend\models\Disbursements;
use backend\models\Liquidations;
/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $date
 * @property string $operating_unit
 * @property string $project_title
 * @property string $department
 * @property string $agency
 * @property string $focal_person
 * @property string $status
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    public $appropriation_type, $year, $fund_cluster, $ors_year, $doc_type;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['operating_unit', 'project_title', 'department', 'focal_person', 'status'], 'required'],
            [['operating_unit', 'project_title', 'department', 'agency', 'focal_person', 'status', 'appropriation_type', 'year', 'fund_cluster', 'ors_year', 'doc_type'], 'string', 'max' => 100],
        ];
    }

    public function getAgency($department, $operating_unit)
    {
        $data = Projects::find()->where(['department' => $department])
                                ->andWhere(['operating_unit' => $operating_unit])
                                ->groupBy(['agency'])
                                ->all();

        return $data;
    }

    public function getOu($department, $agency)
    {
        $data = Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->groupBy(['operating_office'])
                                ->all();
        return $data;
    }

    public function getOrsno($operating_unit, $year, $appropriation_type)
    {
        $data = JournalEntry::find()->where(['operating_unit' => $operating_unit])
                                    //->andWhere(['ors_year' => $year])
                                    ->andWhere(['appropriation_type' => $appropriation_type])
                                    ->all();
        return $data;
    }

    public function getOperatingunit()
    {
        $data = OperatingUnit::find()->where(['abbreviation' => $this->operating_unit])->one();

        return $data;
    }

    public function getProjects($department, $agency, $operating_office)
    {
        $data = Projects::find()->where(['department' => $department])
                                ->andWhere(['agency' => $agency])
                                ->andWhere(['operating_office' => $operating_office])
                                ->all();

        return $data;
    }

    public function getCheckproject($project_id, $appropriation_type)
    {
        $data = Obligations::find()->where(['project_id' => $project_id])
                                    ->andWhere(['appropriation_class' => $appropriation_type])
                                    ->one();

        return $data;
    }

    public function getCheckagency($agency, $ors_year, $appropriation_type)
    {
        $check_data = 0;

        $data = Projects::find()->where(['agency' => $agency])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = Obligations::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_class' => $appropriation_type])
                                        ->andWhere(['ors_year' => $ors_year])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getCheckdepartment($department, $ors_year, $appropriation_type)
    {
        $check_data = 0;

        $data = Projects::find()->where(['department' => $department])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = Obligations::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_class' => $appropriation_type])
                                        ->andWhere(['ors_year' => $ors_year])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getOrs($project_id, $appropriation_class, $ors_year)
    {
        $data = Obligations::find()->where(['project_id' => $project_id])
                                    ->andWhere(['ors_year' => $ors_year])
                                    ->andWhere(['appropriation_class' => $appropriation_class])
                                    ->groupBy(['ors_no'])
                                    ->all();
        return $data;
    }

    public function getObligation($ors_no, $project_id, $quarter, $appropriation_class, $operating_unit, $fund_cluster)
    {
         $date = explode('-', $ors_no);

        if($quarter == 1)
        {
            
            // $year = strtotime("-1 year", date('Y'));
            // $total_obligation = array_sum(ArrayHelper::getColumn(Obligations::find()
            //     ->where(['ors_no' => $ors_no])
            //     ->andWhere(['project_id' => $project_id])
            //     ->andWhere(['fund_cluster' => $fund_cluster])
            //     ->andWhere(['operating_unit' => $operating_unit])
            //     ->andWhere(['between', 'ors_date', date($year.'-01-01'), date($year.'-03-31')])
            //     //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
            //     ->all(), 'obligation'));

            // return $total_obligation;

            $obligations = array_sum(ArrayHelper::getColumn(Obligations::find()
                ->where(['ors_no' => $ors_no])
                ->andWhere(['project_id' => $project_id])
                ->andWhere(['fund_cluster' => $fund_cluster])
                ->andWhere(['operating_unit' => $operating_unit])
                ->andWhere(['appropriation_class' => $appropriation_class])
                // ->andWhere(['ors_year' => date('Y')])
                ->andWhere(['between', 'ors_date', date($date[2].'-01-01'), date($date[2].'-03-31')])
                //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
                ->all(), 'amount'));

            return $obligations;
        }

        if($quarter == 2)
        {
            $obligations = array_sum(ArrayHelper::getColumn(Obligations::find()
                ->where(['ors_no' => $ors_no])
                ->andWhere(['project_id' => $project_id])
                ->andWhere(['fund_cluster' => $fund_cluster])
                ->andWhere(['operating_unit' => $operating_unit])
                ->andWhere(['appropriation_class' => $appropriation_class])
                ->andWhere(['between', 'ors_date', date($date[2].'-04-01'), date($date[2].'-06-30')])
                //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
                ->all(), 'amount'));

            return $obligations;
        }

        if($quarter == 3)
        {
            $obligations = array_sum(ArrayHelper::getColumn(Obligations::find()
                ->where(['ors_no' => $ors_no])
                ->andWhere(['project_id' => $project_id])
                ->andWhere(['fund_cluster' => $fund_cluster])
                ->andWhere(['operating_unit' => $operating_unit])
                ->andWhere(['appropriation_class' => $appropriation_class])
                ->andWhere(['between', 'ors_date', date($date[2].'-07-01'), date($date[2].'-09-30')])
                //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
                ->all(), 'amount'));

            return $obligations;
        }

        if($quarter == 4)
        {

            $obligations = array_sum(ArrayHelper::getColumn(Obligations::find()
                ->where(['ors_no' => $ors_no])
                ->andWhere(['project_id' => $project_id])
                ->andWhere(['fund_cluster' => $fund_cluster])
                ->andWhere(['operating_unit' => $operating_unit])
                ->andWhere(['appropriation_class' => $appropriation_class])
                ->andWhere(['between', 'ors_date', date($date[2].'-10-01'), date($date[2].'-12-31')])
                //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
                ->all(), 'amount'));

            return $obligations;
        }
    }

    public function getTotalobligation($ors_no, $project_id, $appropriation_type, $operating_unit, $fund_cluster)
    {

        $date = explode('-', $ors_no);

        $total_obligations = array_sum(ArrayHelper::getColumn(Obligations::find()
                ->where(['ors_no' => $ors_no])
                ->andWhere(['project_id' => $project_id])
                ->andWhere(['fund_cluster' => $fund_cluster])
                ->andWhere(['operating_unit' => $operating_unit])
                ->andWhere(['appropriation_class' => $appropriation_type])
                ->andWhere(['between', 'ors_date', date($date[2].'-01-01'), date($date[2].'-12-31')])
                //->andFilterWhere(['like', 'ors_date', date('Y', $date)])
                ->all(), 'amount'));

        return $total_obligations;
    }

    public function getDisbursement($ors_no, $project_id, $quarter, $operating_unit, $disbursed_year)
    {
        $date = explode('-', $ors_no);
        if($quarter == 1)
        {
            $disbursements = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'reference_date', date($disbursed_year.'-01-01'), date($date[2].'-03-31')])
                            ->all(), 'amount'));

            return $disbursements;
        }

        if($quarter == 2)
        {
            $disbursements = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'reference_date', date($disbursed_year.'-04-01'), date($date[2].'-06-30')])
                            ->all(), 'amount'));

            return $disbursements;
        }

        if($quarter == 3)
        {
            $disbursements = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'reference_date', date($disbursed_year.'-07-01'), date($date[2].'-09-30')])
                            ->all(), 'amount'));

            return $disbursements;
        }

        if($quarter == 4)
        {
            $disbursements = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'reference_date', date($disbursed_year.'-10-01'), date($date[2].'-12-31')])
                            ->all(), 'amount'));

            return $disbursements;
        }

        if($quarter == 5)
        {
            $disbursements = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'reference_date', date($disbursed_year.'-01-01'), date($date[2].'-12-31')])
                            ->all(), 'amount'));

            return $disbursements;
        }
        
    }

    public function getLiquidation($ors_no, $project_id, $quarter, $operating_unit, $year)
    {
        $date = explode('-', $ors_no);

        if($quarter == 1)
        {
            $liquidation = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'liquidation_date', date($date[2].'-01-01'), date($date[2].'-03-31')])
                            ->all(), 'amount'));

            return $liquidation;
        }

        if($quarter == 2)
        {
            $liquidation = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'liquidation_date', date('Y-04-01'), date('Y-06-30')])
                            ->all(), 'amount'));

            return $liquidation;
        }

        if($quarter == 3)
        {
            $liquidation = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'liquidation_date', date('Y-07-01'), date('Y-09-30')])
                            ->all(), 'amount'));

            return $liquidation;
        }

        if($quarter == 4)
        {
            $liquidation = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'liquidation_date', date('Y-10-01'), date('Y-12-31')])
                            ->all(), 'amount'));

            return $liquidation;
        }

        if($quarter == 5)
        {
            $liquidation = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['between', 'liquidation_date', date('Y-01-01'), date('Y-12-31')])
                            ->all(), 'amount'));

            return $liquidation;
        }
    }

    public function getProjectsagecy($operating_unit)
    {
        $data = Projects::find()->where(['operating_unit' => $operating_unit])
                                    ->groupBy(['department'])
                                    ->all();
        return $data;
    }

    public function getConsolobligation($operating_unit, $appropriation_type, $year, $quarter, $fund_cluster)
    {
        $total_obligation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'obligation'));

        return $total_obligation;
    }

    public function getConsolobligationtotal($operating_unit, $appropriation_type, $year, $fund_cluster)
    {
        $total_obligationtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->all(), 'obligation'));

        return $total_obligationtotal;
    }

    public function getConsoldisbursement($operating_unit, $appropriation_type, $year, $quarter, $fund_cluster)
    {
        $total_disbursement = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'disbursement'));

        return $total_disbursement;
    }

    public function getConsoldisbursementtotal($operating_unit, $appropriation_type, $year, $fund_cluster)
    {
        $total_disbursementtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->all(), 'disbursement'));

        return $total_disbursementtotal;
    }

    public function getConsolliquidation($operating_unit, $appropriation_type, $year, $quarter, $fund_cluster)
    {
        $total_liquidation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'liquidation'));

        return $total_liquidation;
    }

    public function getConsolliquidationtotal($operating_unit, $appropriation_type, $year, $fund_cluster)
    {
        $total_disbursementtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->all(), 'liquidation'));

        return $total_disbursementtotal;
    }

    // public function getQuarter()
    // {
    //     if((strtotime(date('Y-m-d')) < strtotime(date('Y-04-01'))) || (strtotime(date('Y-m-d')) > strtotime(date('Y-01-01'))))
    //     {
    //         $date = "March 31, ".date('Y');
    //         return $date;
    //     }
    // }    
    //public function getLiquidation($ors_no, $project_id, $quarter, $operating_unit, $year)

    public function getExpenceob($operating_unit, $project_id, $expense_class, $appropriation_type, $quarter, $year)
    {
        if($quarter == 1)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Obligations::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_class' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'ors_date', date($year.'-01-01'), date($year.'-03-31')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 2)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Obligations::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_class' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'ors_date', date($year.'-04-01'), date($year.'-06-30')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 3)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Obligations::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_class' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'ors_date', date($year.'-07-01'), date($year.'-09-30')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 4)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Obligations::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_class' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'ors_date', date($year.'-10-01'), date($year.'-12-31')])
                            ->all(), 'amount'));

            return $total_expense;
        }
    }

    public function getExpenceobtotal($operating_unit, $project_id, $expense_class, $appropriation_type, $year)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(obligations::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_class' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'ors_date', date($year.'-01-01'), date($year.'-12-31')])
                            ->all(), 'amount'));

        return $total_expense;
    }

    public function getExpenceDis($operating_unit, $project_id, $expense_class, $quarter, $year)
    {
        if ($quarter == 1)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'reference_date', date($year.'-01-01'), date($year.'-03-31')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if ($quarter == 2)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'reference_date', date($year.'-04-01'), date($year.'-06-30')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if ($quarter == 3)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'reference_date', date($year.'-07-01'), date($year.'-09-30')])
                            ->all(), 'amount'));

            return $total_expense;
        }

        if ($quarter == 4)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'reference_date', date($year.'-10-01'), date($year.'-12-31')])
                            ->all(), 'amount'));

            return $total_expense;
        }
        
    }

    public function getExpenceDistotal($operating_unit, $project_id, $expense_class, $year)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(Disbursements::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'reference_date', date($year.'-01-01'), date($year.'-12-31')])
                            ->all(), 'amount'));

        return $total_expense;
    }

    public function getExpenceliq($operating_unit, $project_id, $expense_class, $quarter, $year)
    {
        if($quarter == 1)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Liquidations::find()
                                ->where(['operating_unit' => $operating_unit])
                                //->andWhere(['appropriation_type' => $appropriation_type])
                                ->andWhere(['project_id' => $project_id])
                                ->andWhere(['ors_class' => $expense_class])
                                ->andWhere(['between', 'liquidation_date', date($year.'-01-01'), date($year.'-03-31')])
                                ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 2)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Liquidations::find()
                                ->where(['operating_unit' => $operating_unit])
                                //->andWhere(['appropriation_type' => $appropriation_type])
                                ->andWhere(['project_id' => $project_id])
                                ->andWhere(['ors_class' => $expense_class])
                                ->andWhere(['between', 'liquidation_date', date($year.'-04-01'), date($year.'-06-30')])
                                ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 3)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Liquidations::find()
                                ->where(['operating_unit' => $operating_unit])
                                //->andWhere(['appropriation_type' => $appropriation_type])
                                ->andWhere(['project_id' => $project_id])
                                ->andWhere(['ors_class' => $expense_class])
                                ->andWhere(['between', 'liquidation_date', date($year.'-07-01'), date($year.'-09-30')])
                                ->all(), 'amount'));

            return $total_expense;
        }

        if($quarter == 4)
        {
            $total_expense = array_sum(ArrayHelper::getColumn(Liquidations::find()
                                ->where(['operating_unit' => $operating_unit])
                                //->andWhere(['appropriation_type' => $appropriation_type])
                                ->andWhere(['project_id' => $project_id])
                                ->andWhere(['ors_class' => $expense_class])
                                ->andWhere(['between', 'liquidation_date', date($year.'-10-01'), date($year.'-12-31')])
                                ->all(), 'amount'));

            return $total_expense;
        }
            
    }

    public function getExpenceliqtotal($operating_unit, $project_id, $expense_class, $year)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(Liquidations::find()
                            ->where(['operating_unit' => $operating_unit])
                            //->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['between', 'liquidation_date', date($year.'-01-01'), date($year.'-12-31')])
                            ->all(), 'amount'));

        return $total_expense;
    }

    public function getMonthlydisbursement($project_id)
    {
        $monthly_disbursement = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(Disbursements::find()
                    ->where(['project_id' => $project_id])
                    ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                    ->andFilterWhere(['like', 'reference_date', date('Y-m', $date)])
                    ->all(), 'amount'));

            array_push($monthly_disbursement, $data);

            $date = strtotime( "+1 month", $date);
        }

        return $monthly_disbursement;
        
    }

    public function getMonthlyobligation($project_id)
    {
        $monthly_utilization = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(Obligations::find()
                    ->where(['project_id' => $project_id])
                    ->andWhere(['operating_unit' => Yii::$app->user->identity->region])
                    ->andFilterWhere(['like', 'ors_date', date('Y-m', $date)])
                    ->all(), 'amount'));

            array_push($monthly_utilization, $data);

            $date = strtotime( "+1 month", $date);
        }

        return $monthly_utilization;
        
    }

    public function getMonthlyliquidation($project_id)
    {
        $monthly_liquidation = [];
        $date = strtotime(date('Y-01-01'));

        for ($i=1; $i < 13; $i++)
        {
            $data = array_sum(ArrayHelper::getColumn(Liquidations::find()
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
            'date' => 'Date',
            'operating_unit' => 'Operating Unit',
            'operating_office' => 'Operating Office',
            'project_title' => 'Project Title',
            'department' => 'Department',
            'agency' => 'Agency',
            'focal_person' => 'Focal Person',
            'status' => 'Status',
        ];
    }
}
