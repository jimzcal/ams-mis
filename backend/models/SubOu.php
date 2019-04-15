<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sub_ou".
 *
 * @property int $id
 * @property string $mother_unit
 * @property string $sub_ou
 * @property string $description
 * @property string $status
 */
class SubOu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_ou';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mother_unit', 'sub_ou', 'description', 'status'], 'required'],
            [['mother_unit', 'sub_ou', 'status'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mother_unit' => 'Mother Unit',
            'sub_ou' => 'Sub OU',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
