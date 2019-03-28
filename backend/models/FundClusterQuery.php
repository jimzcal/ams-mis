<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[FundCluster]].
 *
 * @see FundCluster
 */
class FundClusterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FundCluster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FundCluster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
