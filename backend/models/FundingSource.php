<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "funding_source".
 *
 * @property int $id
 * @property string $description
 * @property string $uacs
 */
class FundingSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funding_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'uacs'], 'required'],
            [['description', 'uacs'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'uacs' => 'UACS Code',
        ];
    }
}
