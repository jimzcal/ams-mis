<?php

namespace backend\models;

use Yii;
use backend\models\JournalEntry;
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

    public function getAgency($department)
    {
        $data = Projects::find()->where(['department' => $department])
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
                                    ->andWhere(['ors_year' => $year])
                                    ->groupBy(['ors_no'])
                                    ->all();
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

    public function getObligation($ors_no, $project_id, $quarter, $appropriation_type, $operating_unit, $year, $fund_cluster)
    {
        $total_obligation = array_sum(ArrayHelper::getColumn(JournalEntry::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['project_id' => $project_id])
                            // ->andWhere(['year' => $year])
                            ->andWhere(['ors_year' => $year])
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
                            ->andWhere(['ors_year' => $year])
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
                            ->andWhere(['ors_year' => $year])
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
                            ->andWhere(['year' => $year])
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
                            ->andWhere(['year' => $year])
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
                            ->andWhere(['year' => $year])
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
