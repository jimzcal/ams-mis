<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "my_dvlogs".
 *
 * @property int $id
 * @property string $date
 * @property string $dv_no
 * @property string $lddap_ada
 * @property string $lddap_ada_date
 * @property string $date_out
 * @property int $user_id
 */
class MyDvlogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my_dvlogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'lddap_ada_date', 'date_out'], 'safe'],
            [['dv_no', 'lddap_ada', 'lddap_ada_date', 'date_out', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['dv_no', 'lddap_ada'], 'string', 'max' => 100],
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
            'dv_no' => 'Dv No',
            'lddap_ada' => 'Lddap Ada',
            'lddap_ada_date' => 'Lddap Ada Date',
            'date_out' => 'Date Out',
            'user_id' => 'User ID',
        ];
    }
}
