<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transaction_status".
 *
 * @property int $id
 * @property string $dv_no
 * @property string $receiving
 * @property string $processing
 * @property string $nca_control
 * @property string $verification
 * @property string $lddap_ada
 * @property string $releasing
 *
 * @property Disbursement $dvNo
 */
class TransactionStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_no', 'receiving', 'processing', 'nca_control', 'verification', 'lddap_ada', 'releasing'], 'required'],
            [['receiving', 'processing', 'nca_control', 'verification', 'lddap_ada', 'releasing'], 'string'],
            [['dv_no'], 'string', 'max' => 200],
            [['dv_no'], 'exist', 'skipOnError' => true, 'targetClass' => Disbursement::className(), 'targetAttribute' => ['dv_no' => 'dv_no']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dv_no' => 'Dv No',
            'receiving' => 'Receiving',
            'processing' => 'Processing',
            'nca_control' => 'Nca Control',
            'verification' => 'Verification',
            'lddap_ada' => 'Lddap Ada',
            'releasing' => 'Releasing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDvNo()
    {
        return $this->hasOne(Disbursement::className(), ['dv_no' => 'dv_no']);
    }

    /**
     * @inheritdoc
     * @return TransactionStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionStatusQuery(get_called_class());
    }
}
