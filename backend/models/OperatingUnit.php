<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "operating_unit".
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $description
 * @property string $status
 */
class OperatingUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operating_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['abbreviation', 'description', 'status'], 'required'],
            [['abbreviation', 'description', 'status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'abbreviation' => 'Abbreviation',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
