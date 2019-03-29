<?php

namespace backend\models;

use Yii;
use backend\models\Ors;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $region
 * @property string $sub_office
 * @property string $date
 * @property string $title
 * @property string $implementing_agency
 * @property string $focal_person
 * @property string $ors_no
 * @property string $status
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region', 'sub_office', 'title', 'implementing_agency', 'focal_person', 'ors_no'], 'required'],
            [['date', 'ors_no'], 'safe'],
            [['region', 'sub_office', 'focal_person', 'status'], 'string', 'max' => 100],
            [['title', 'implementing_agency'], 'string', 'max' => 200],
        ];
    }

    public function getOrs($ors_no, $region)
    {
        $data = Ors::find()->where(['ors_no' => $ors_no])
                    ->andWhere(['region' => $region])
                    ->groupBy(['rc', 'mfo_pap', 'object_code'])
                    ->one();

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'sub_office' => 'Sub Office',
            'date' => 'Date',
            'title' => 'Project Title',
            'implementing_agency' => 'Implementing Agency',
            'focal_person' => 'Focal Person',
            'ors_no' => 'ORS No',
            'status' => 'Status',
        ];
    }
}
