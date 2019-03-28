<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nca".
 *
 * @property int $id
 * @property string $date_received
 * @property string $nca_no
 * @property string $fund_cluster
 * @property string $mds_sub_acc_no
 * @property string $gsb_branch
 * @property string $purpose
 * @property string $fiscal_year
 * @property string $january
 * @property string $february
 * @property string $march
 * @property string $april
 * @property string $may
 * @property string $june
 * @property string $july
 * @property string $august
 * @property string $september
 * @property string $october
 * @property string $november
 * @property string $december
 * @property string $total_amount
 *
 * @property Disbursement[] $disbursements
 * @property FundCluster $fundCluster
 */
class Nca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_received', 'nca_no', 'fund_cluster', 'mds_sub_acc_no', 'gsb_branch', 'purpose', 'fiscal_year', 'total_amount'], 'required'],
            [['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december', 'total_amount'], 'number'],
            [['date_received', 'fund_cluster', 'gsb_branch', 'fiscal_year'], 'string', 'max' => 100],
            [['nca_no', 'mds_sub_acc_no', 'purpose'], 'string', 'max' => 200],
            [['fund_cluster'], 'exist', 'skipOnError' => true, 'targetClass' => FundCluster::className(), 'targetAttribute' => ['fund_cluster' => 'fund_cluster']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_received' => 'Date Received',
            'nca_no' => 'NCA No',
            'fund_cluster' => 'Fund Cluster',
            'mds_sub_acc_no' => 'MDS Sub-Account No',
            'gsb_branch' => 'GSB Branch',
            'purpose' => 'Purpose',
            'fiscal_year' => 'Fiscal Year',
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'october' => 'October',
            'november' => 'November',
            'december' => 'December',
            'total_amount' => 'Total Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisbursements()
    {
        return $this->hasMany(Disbursement::className(), ['nca' => 'nca_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundCluster()
    {
        return $this->hasOne(FundCluster::className(), ['fund_cluster' => 'fund_cluster']);
    }

    /**
     * @inheritdoc
     * @return NcaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NcaQuery(get_called_class());
    }
}
