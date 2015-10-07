<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "institution".
 *
 * @property integer $inst_id
 * @property string $inst_code
 * @property string $inst_name
 *
 * @property EducationInformation[] $educationInformations
 * @property InstitutionCourse[] $institutionCourses
 */
class Institution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inst_name'], 'required'],
            [['inst_code'], 'string', 'max' => 10],
            [['inst_name'], 'string', 'max' => 225]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inst_id' => 'Inst ID',
            'inst_code' => 'Inst Code',
            'inst_name' => 'Inst Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationInformations()
    {
        return $this->hasMany(EducationInformation::className(), ['inst_id' => 'inst_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutionCourses()
    {
        return $this->hasMany(InstitutionCourse::className(), ['inst_id' => 'inst_id']);
    }
}
