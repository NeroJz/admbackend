<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $course_id
 * @property string $course_code
 * @property string $course_name
 *
 * @property EducationInformation[] $educationInformations
 * @property InstitutionCourse[] $institutionCourses
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_name'], 'required'],
            [['course_code', 'course_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_code' => 'Course Code',
            'course_name' => 'Course Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationInformations()
    {
        return $this->hasMany(EducationInformation::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutionCourses()
    {
        return $this->hasMany(InstitutionCourse::className(), ['course_id' => 'course_id']);
    }

    public function findUniCourse(){
        $query = (new \yii\db\Query());
        return $query->select(['inst_id','course.course_id','course_code','course_name','course_status'])
            ->from('institution_course')
            ->innerJoin('course', 'course.course_id = institution_course.course_id')
            ->all();
    }
}
