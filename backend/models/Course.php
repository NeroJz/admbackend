<?php

namespace backend\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

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
            [['course_code', 'course_name'], 'required'],
            [['course_code', 'course_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'course_id' => 'Course ID',
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

    /**
     * @inheritdoc
     * @return CourseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CourseQuery(get_called_class());
    }

    public static function getCourseName($id)
    {
      
        $course = User::findBySql('SELECT c.* FROM course c join institution_course ic on c.course_id = ic.course_id  where ic.inst_id='.$id.'')
                 ->asArray()
                 ->all();



         return $course;
    }

    public static function getCourseReport($factID,$start,$end)
    {

       /* $user = User::findBySql("SELECT COUNT(ue.id) as totalstudent, i.*,GROUP_CONCAT(ue.id, '|', ei.ei_graduation_year ORDER BY ei.ei_graduation_year) as student FROM institution i join university u on i.uni_id = u.uni_id ".
                                'join education_information ei on i.inst_id = ei.inst_id '.
                                'join user_education ue on ei.ei_id = ue.ue_id '.
                                'join user us on ue.id = us.id '.
                                'WHERE ei.ei_graduation_year BETWEEN '.$start.' AND '.$end.' '.
                                'AND ei.inst_id = '.$factID.' '.
                                'AND u.uni_status = "1" '.
                                'GROUP BY ei.inst_id')*/
     $user = User::findBySql("SELECT c.*, GROUP_CONCAT(ei.ei_id, '|' , ei.ei_graduation_year ORDER BY ei.ei_graduation_year) as students FROM education_information ei ".
                             //"JOIN education_information ei on ue.ei_id = ei.ei_id ".
                             "JOIN course c on ei.course_id = c.course_id ".
                             "JOIN institution_course ic on c.course_id = ic.course_id ".
                             "JOIN institution i on ei.inst_id = i.inst_id ".
                             'join university u on i.uni_id = u.uni_id '.
                             "WHERE ei.ei_graduation_year BETWEEN ".$start." AND ".$end." ".
                             "AND i.inst_id = ".$factID." ".
                             "GROUP BY ei.course_id")
                 ->asArray()
                 ->all();

         return $user;



    }

    public function getCourseByFaculty($factID)
    {
        $user = User::findBySql("SELECT c.* FROM course c ".
                                "JOIN institution_course ic on c.course_id = ic.course_id ".
                                "JOIN institution i on ic.inst_id = i.inst_id ".
                                'join university u on i.uni_id = u.uni_id '.
                                "WHERE i.inst_id = ".$factID." ")
                    ->asArray()
                    ->all();

            return $user;

    }


}
