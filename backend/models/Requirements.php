<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "requirements".
 *
 * @property integer $id
 * @property string $requirement
 */
class Requirements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requirements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requirements'], 'required'],
            [['requirements'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requirements' => 'Requirements',
        ];
    }
}
