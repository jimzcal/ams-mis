<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Disbursement]].
 *
 * @see Disbursement
 */
class DisbursementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Disbursement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Disbursement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
