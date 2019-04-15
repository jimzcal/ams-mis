<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property int $id
 * @property string $date
 * @property string $po_no
 * @property string $supplier
 * @property string $tin
 * @property string $mode_procurement
 * @property int $payment_term
 * @property string $description
 * @property string $total_amount
 * @property string $date_recived
 * @property string $fund_cluster
 * @property string $status
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    public $date_from, $date_to, $dv_no;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'po_no', 'supplier', 'tin', 'mode_procurement', 'payment_term', 'description', 'total_amount', 'date_recived', 'fund_cluster', 'status'], 'required'],
            [['date', 'date_recived', 'date_from', 'date_to', 'attachments'], 'safe'],
            [['payment_term'], 'integer'],
            [['description'], 'string'],
            [['total_amount'], 'number'],
            [['po_no', 'supplier', 'tin', 'mode_procurement', 'fund_cluster', 'status', 'dv_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'po_no' => 'PO No',
            'supplier' => 'Supplier',
            'tin' => 'TIN',
            'attachments' => 'Attachments',
            'mode_procurement' => 'Mode of Procurement',
            'payment_term' => 'Payment Term (days)',
            'description' => 'Description',
            'total_amount' => 'Amount',
            'date_recived' => 'Date Received',
            'fund_cluster' => 'Fund Cluster',
            'status' => 'Status',
        ];
    }
}
