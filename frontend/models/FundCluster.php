<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fund_cluster".
 *
 * @property int $id
 * @property string $fund_cluster
 * @property string $descripion
 *
 * @property Nca[] $ncas
 */
class FundCluster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fund_cluster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fund_cluster', 'description'], 'required'],
            [['fund_cluster', 'description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fund_cluster' => 'Fund Cluster',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNcas()
    {
        return $this->hasMany(Nca::className(), ['fund_cluster' => 'fund_cluster']);
    }

    /**
     * @inheritdoc
     * @return FundClusterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FundClusterQuery(get_called_class());
    }
}
