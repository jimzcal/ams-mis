<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "responsibility_center".
 *
 * @property int $id
 * @property string $description
 * @property string $acronym
 * @property string $code
 */
class ResponsibilityCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responsibility_center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'acronym', 'code'], 'required'],
            [['description', 'acronym', 'code'], 'string', 'max' => 100],
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
            'acronym' => 'Acronym',
            'code' => 'Code',
        ];
    }
}
