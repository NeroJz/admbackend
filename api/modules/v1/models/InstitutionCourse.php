<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "institution_course".
 *
 * @property integer $ic_id
 * @property integer $inst_id
 * @property integer $course_id
 *
 * @property Course $course
 * @property Institution $inst
 */
class InstitutionCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institution_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inst_id', 'course_id'], 'required'],
            [['inst_id', 'course_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ic_id' => 'Ic ID',
            'inst_id' => 'Inst ID',
            'course_id' => 'Course ID',
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
}
