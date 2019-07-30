<?php

namespace backend\models;

use Yii;
use backend\models\Projects;

/**
 * This is the model class for table "obligations".
 *
 * @property int $id
 * @property string $date_entry
 * @property int $project_id
 * @property string $operating_unit
 * @property string $ors_no
 * @property string $appropriation_class
 * @property string $particulars
 * @property string $ors_class
 * @property string $funding_source
 * @property int $ors_year
 * @property string $ors_month
 * @property string $ors_serial
 * @property string $mfo_pap
 * @property string $rc
 * @property string $object_code
 */
class Obligations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obligations';
    }

    public $ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_entry'], 'safe'],
            [['project_id', 'operating_unit', 'ors_no', 'appropriation_class', 'particulars', 'ors_class', 'funding_source', 'ors_year', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'amount', 'payee', 'ors_date', 'fund_cluster'], 'required'],
            [['project_id', 'ors_year', 'ids'], 'integer'],
            [['amount'], 'number'],
            [['particulars'], 'string'],
            [['operating_unit', 'ors_no', 'appropriation_class', 'ors_class', 'funding_source', 'ors_month', 'ors_serial', 'mfo_pap', 'rc', 'object_code', 'fund_cluster'], 'string', 'max' => 100],
        ];
    }

    public function getProject()
    {
        return Projects::find()->where(['id' => $this->project_id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_entry' => 'Date Entry',
            'project_id' => 'Project Title',
            'operating_unit' => 'Operating Unit',
            'ors_no' => 'ORS No',
            'appropriation_class' => 'Appropriation Class',
            'particulars' => 'Particulars',
            'ors_class' => 'ORS Class',
            'funding_source' => 'Funding Source',
            'ors_year' => 'Ors Year',
            'ors_date' => 'ORS Date',
            'ors_month' => 'Ors Month',
            'ors_serial' => 'Ors Serial',
            'mfo_pap' => 'Mfo Pap',
            'rc' => 'Rc',
            'object_code' => 'Object Code',
            'amount' => 'Amount',
            'fund_cluster' => 'Fund Cluster',
            'payee' => 'Payee',
        ];
    }
}
