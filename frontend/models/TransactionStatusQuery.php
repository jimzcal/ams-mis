<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[TransactionStatus]].
 *
 * @see TransactionStatus
 */
class TransactionStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TransactionStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransactionStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
