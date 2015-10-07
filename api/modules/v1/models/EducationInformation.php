<?php

namespace api\modules\v1\models;

use Yii;


use yii\web\IdentityInterface;

/**
 * This is the model class for table "education_information".
 *
 * @property integer $ei_id
 * @property integer $inst_id
 * @property integer $course_id
 * @property integer $el_id
 * @property integer $ei_graduation_year
 *
 * @property Course $course
 * @property Institution $inst
 * @property EducationLevel $el
 * @property UserEducation[] $userEducations
 */
class EducationInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'education_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inst_id', 'course_id', 'el_id', 'ei_graduation_year'], 'required'],
            [['inst_id', 'course_id', 'el_id', 'ei_graduation_year'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ei_id' => 'Ei ID',
            'inst_id' => 'Inst ID',
            'course_id' => 'Course ID',
            'el_id' => 'El ID',
            'ei_graduation_year' => 'Ei Graduation Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInst()
    {
        return $this->hasOne(Institution::className(), ['inst_id' => 'inst_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEl()
    {
        return $this->hasOne(EducationLevel::className(), ['el_id' => 'el_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEducations()
    {
        return $this->hasMany(UserEducation::className(), ['ei_id' => 'ei_id']);
    }
}
