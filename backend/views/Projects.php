<?php

namespace backend\models;

use Yii;
use backend\models\JournalEntry;
use backend\models\OperatingUnit;
use yii\helpers\ArrayHelper;
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

    public $appropriation_type, $year, $fund_cluster;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['operating_unit', 'project_title', 'department', 'focal_person', 'status'], 'required'],
            [['operating_unit', 'project_title', 'department', 'agency', 'focal_person', 'status', 'appropriation_type', 'year', 'fund_cluster'], 'string', 'max' => 100],
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

    public function getOrs($project_id, $year)
    {
        $data = JournalEntry::find()->where(['project_id' => $project_id])
                                    //->andWhere(['ors_year' => $year])
                                    ->groupBy(['ors_no'])
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
        $data = JournalEntry::find()->where(['project_id' => $project_id])
                                    ->andWhere(['appropriation_type' => $appropriation_type])
                                    ->one();

        return $data;
    }

    public function getCheckagency($agency, $appropriation_type)
    {
        $check_data = 0;

        $data = Projects::find()->where(['agency' => $agency])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = JournalEntry::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_type' => $appropriation_type])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getCheckdepartment($department, $appropriation_type)
    {
        $check_data = 0;

        $data = Projects::find()->where(['department' => $department])
                                ->all();

        foreach ($data as $key => $value) 
        {
            $check = JournalEntry::find()->where(['project_id' => $value->id])
                                        ->andWhere(['appropriation_type' => $appropriation_type])
                                        ->one();
            $check_data = $check != null ? $check_data + 1 : $check_data + 0;
        }

        return $check_data;
    }

    public function getObligation($ors_no, $project_id, $quarter, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_obligation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            // ->andWhere(['year' => $year])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['quarter' => $quarter])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'obligation'));

        return $total_obligation;
    }

    public function getTotalobligation($ors_no, $project_id, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_obligation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            // ->andWhere(['year' => $year])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'obligation'));

        return $total_obligation;
    }

    public function getDisbursement($ors_no, $project_id, $quarter, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_disbursement = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            // ->andWhere(['year' => $year])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['quarter' => $quarter])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'disbursement'));

        return $total_disbursement;
    }

    public function getTotaldisbursement($ors_no, $project_id, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_disbursement = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'disbursement'));

        return $total_disbursement;
    }

    public function getLiquidation($ors_no, $project_id, $quarter, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_liquidation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['quarter' => $quarter])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'liquidation'));

        return $total_liquidation;
    }

    public function getTotalliquidation($ors_no, $project_id, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_liquidation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['fund_cluster' => $fund_cluster])
                            ->andWhere(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->all(), 'liquidation'));

        return $total_liquidation;
    }

    public function getProjectsagecy($operating_unit)
    {
        $data = Projects::find()->where(['operating_unit' => $operating_unit])
                                    ->groupBy(['department'])
                                    ->all();
        return $data;
    }

    public function getConsolobligation($operating_unit, $appropriation_type, $year, $quarter)
    {
        $total_obligation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'obligation'));

        return $total_obligation;
    }

    public function getConsolobligationtotal($operating_unit, $appropriation_type, $year)
    {
        $total_obligationtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
                            ->all(), 'obligation'));

        return $total_obligationtotal;
    }

    public function getConsoldisbursement($operating_unit, $appropriation_type, $year, $quarter)
    {
        $total_disbursement = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'disbursement'));

        return $total_disbursement;
    }

    public function getConsoldisbursementtotal($operating_unit, $appropriation_type, $year)
    {
        $total_disbursementtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
                            ->all(), 'disbursement'));

        return $total_disbursementtotal;
    }

    public function getConsolliquidation($operating_unit, $appropriation_type, $year, $quarter)
    {
        $total_liquidation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'liquidation'));

        return $total_liquidation;
    }

    public function getConsolliquidationtotal($operating_unit, $appropriation_type, $year)
    {
        $total_disbursementtotal = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            //->andWhere(['ors_year' => $year])
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

    public function getExpenceob($operating_unit, $project_id, $expense_class, $appropriation_type, $quarter)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'obligation'));

        return $total_expense;
    }

    public function getExpenceobtotal($operating_unit, $project_id, $expense_class, $appropriation_type)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['project_id' => $project_id])
                            ->all(), 'obligation'));

        return $total_expense;
    }

    public function getExpenceDis($operating_unit, $project_id, $expense_class, $appropriation_type, $quarter)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'disbursement'));

        return $total_expense;
    }

    public function getExpenceDistotal($operating_unit, $project_id, $expense_class, $appropriation_type)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->all(), 'disbursement'));

        return $total_expense;
    }

    public function getExpenceliq($operating_unit, $project_id, $expense_class, $appropriation_type, $quarter)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->andWhere(['quarter' => $quarter])
                            ->all(), 'liquidation'));

        return $total_expense;
    }

    public function getExpenceliqtotal($operating_unit, $project_id, $expense_class, $appropriation_type)
    {
        $total_expense = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['operating_unit' => $operating_unit])
                            ->andWhere(['appropriation_type' => $appropriation_type])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['ors_class' => $expense_class])
                            ->all(), 'liquidation'));

        return $total_expense;
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
