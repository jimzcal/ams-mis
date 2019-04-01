<?php

namespace backend\models;

use Yii;
use backend\models\Ors;
use yii\helpers\ArrayHelper;
use backend\models\DisbursedDv;
use backend\models\Liquidation;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $region
 * @property string $sub_office
 * @property string $date
 * @property string $title
 * @property string $implementing_agency
 * @property string $focal_person
 * @property string $ors_no
 * @property string $status
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public $appropriation_class;

    public function rules()
    {
        return [
            [['region', 'sub_office', 'title', 'implementing_agency', 'focal_person', 'ors_no'], 'required'],
            [['date', 'ors_no', 'appropriation_class'], 'safe'],
            [['region', 'sub_office', 'focal_person', 'status'], 'string', 'max' => 100],
            [['title', 'implementing_agency'], 'string', 'max' => 200],
        ];
    }

    public function getOrs($ors_no, $region)
    {
        $data = Ors::find()->where(['ors_no' => $ors_no])
                    ->andWhere(['region' => $region])
                    ->groupBy(['rc', 'mfo_pap', 'object_code'])
                    ->one();

        return $data;
    }

    public function getOrsdetails($ors_no, $region)
    {
        $data = Ors::find()->where(['ors_no' => $ors_no])
                    ->andWhere(['region' => $region])
                    ->all();

        return $data;
    }

    public function getObligatedfirst($ors_no, $region, $project_id, $date, $appropriation_class)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(Obligated::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['appropriation_class' => $appropriation_class])
                            ->andWhere(['between', 'date', date('Y-01-01', strtotime($date)), date('Y-03-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getObligatedsecond($ors_no, $region, $project_id, $date, $appropriation_class)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(Obligated::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['appropriation_class' => $appropriation_class])
                            ->andWhere(['between', 'date', date('Y-04-01', strtotime($date)), date('Y-06-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getObligatedthird($ors_no, $region, $project_id, $date, $appropriation_class)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(Obligated::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['appropriation_class' => $appropriation_class])
                            ->andWhere(['between', 'date', date('Y-07-01', strtotime($date)), date('Y-9-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getObligatedfourth($ors_no, $region, $project_id, $date, $appropriation_class)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(Obligated::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['appropriation_class' => $appropriation_class])
                            ->andWhere(['between', 'date', date('Y-10-01', strtotime($date)), date('Y-12-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getObligatedtotal($ors_no, $region, $project_id, $date, $appropriation_class)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(Obligated::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['appropriation_class' => $appropriation_class])
                            ->andWhere(['project_id' => $project_id])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getDisbursedfirst($ors_no, $region, $project_id, $date)
    {
        $total_disbursed = array_sum(ArrayHelper::getColumn(DisbursedDv::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-01-01', strtotime($date)), date('Y-03-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_disbursed;
    }

    public function getDisbursedsecond($ors_no, $region, $project_id, $date)
    {
        $total_disbursed = array_sum(ArrayHelper::getColumn(DisbursedDv::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-04-01', strtotime($date)), date('Y-06-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_disbursed;
    }

    public function getDisbursedthird($ors_no, $region, $project_id, $date)
    {
        $total_disbursed = array_sum(ArrayHelper::getColumn(DisbursedDv::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-07-01', strtotime($date)), date('Y-9-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_disbursed;
    }

    public function getDisbursedfourth($ors_no, $region, $project_id, $date)
    {
        $total_disbursed = array_sum(ArrayHelper::getColumn(DisbursedDv::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-10-01', strtotime($date)), date('Y-12-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_disbursed;
    }

    public function getDisbursedtotal($ors_no, $region, $project_id)
    {
        $total_obligated = array_sum(ArrayHelper::getColumn(DisbursedDv::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->all(), 'amount'));

        return $total_obligated;
    }

    public function getLiquidatedfirst($ors_no, $region, $project_id, $date)
    {
        $total_liquidated = array_sum(ArrayHelper::getColumn(Liquidation::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-01-01', strtotime($date)), date('Y-03-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_liquidated;
    }

    public function getLiquidatedsecond($ors_no, $region, $project_id, $date)
    {
        $total_liquidated = array_sum(ArrayHelper::getColumn(Liquidation::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-04-01', strtotime($date)), date('Y-06-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_liquidated;
    }

    public function getLiquidatedthird($ors_no, $region, $project_id, $date)
    {
        $total_liquidated = array_sum(ArrayHelper::getColumn(Liquidation::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-07-01', strtotime($date)), date('Y-09-30', strtotime($date))])
                            ->all(), 'amount'));

        return $total_liquidated;
    }

    public function getLiquidatedfourth($ors_no, $region, $project_id, $date)
    {
        $total_liquidated = array_sum(ArrayHelper::getColumn(Liquidation::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->andWhere(['between', 'date', date('Y-10-01', strtotime($date)), date('Y-12-31', strtotime($date))])
                            ->all(), 'amount'));

        return $total_liquidated;
    }

    public function getLiquidatedtotal($ors_no, $region, $project_id)
    {
        $total_liquidated = array_sum(ArrayHelper::getColumn(Liquidation::find()
                            ->where(['ors_no' => $ors_no])
                            ->andWhere(['region' => $region])
                            ->andWhere(['project_id' => $project_id])
                            ->all(), 'amount'));

        return $total_liquidated;
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'sub_office' => 'Sub Office',
            'date' => 'Date',
            'title' => 'Project Title',
            'implementing_agency' => 'Implementing Agency',
            'focal_person' => 'Focal Person',
            'ors_no' => 'ORS No',
            'status' => 'Status',
        ];
    }
}
