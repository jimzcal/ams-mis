<?php

namespace backend\models;

use Yii;

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
            [['region', 'sub_office', 'title', 'implementing_agency', 'focal_person', 'ors_no', 'status'], 'required'],
            [['date'], 'safe'],
            [['region', 'sub_office', 'focal_person', 'status'], 'string', 'max' => 100],
            [['title', 'implementing_agency', 'ors_no'], 'string', 'max' => 200],
        ];
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
            'title' => 'Title',
            'implementing_agency' => 'Implementing Agency',
            'focal_person' => 'Focal Person',
            'ors_no' => 'Ors No',
            'status' => 'Status',
        ];
    }
}
