<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $employee_id
 * @property string $photo
 * @property string $name
 * @property string $position
 * @property string $office
 * @property string $password
 * @property string $biometrix
 * @property string $qr_code
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'name', 'position', 'office', 'password', 'biometrix', 'qr_code'], 'required'],
            [['photo'], 'safe'],
            [['employee_id', 'name', 'position', 'office', 'password', 'biometrix', 'qr_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'photo' => 'Photo',
            'name' => 'Name',
            'position' => 'Position',
            'office' => 'Office',
            'password' => 'Password',
            'biometrix' => 'Biometrix',
            'qr_code' => 'Qr Code',
        ];
    }
}
