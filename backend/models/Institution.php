<?php

namespace backend\models;

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
          //  [['inst_name'], 'required'],
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
           // 'inst_id' => 'Inst ID',
            'inst_code' => 'Faculty Code',
            'inst_name' => 'Faculty Name',
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
    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['uni_id' => 'uni_id']);
    }

    /**
     * @inheritdoc
     * @return InstitutionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstitutionQuery(get_called_class());
    }

    public static function getUniFaculty($id)
    {
        $user = User::findBySql('SELECT u.*, i.* FROM institution i join university u on i.uni_id = u.uni_id where i.inst_id='.$id.'')
                 ->asArray()
                 ->all();

         return $user;
    }

    public static function getCurrentFaculty()
    {
        $user = User::findBySql('SELECT i.* FROM institution i join university u on i.uni_id = u.uni_id WHERE u.uni_status = "1"')
                 ->asArray()
                 ->all();

         return $user;

    }

    public static function getFacultyReport($start,$end)
    {

    /*    $user = User::findBySql("SELECT COUNT(ue.id) as totalstudent, i.*,GROUP_CONCAT(ue.id, '|', ei.ei_graduation_year ORDER BY ei.ei_graduation_year) as student FROM institution i join university u on i.uni_id = u.uni_id ".
                                'left join education_information ei on i.inst_id = ei.inst_id '.
                                'left join user_education ue on ei.ei_id = ue.ue_id '.
                                'left join user us on ue.id = us.id '.
                                'WHERE ei.ei_graduation_year BETWEEN '.$start.' AND '.$end.' '.
                                'AND u.uni_status = "1" '.
                                'GROUP BY ei.inst_id')*/
;
         $user = User::findBySql("SELECT i.*,GROUP_CONCAT(ei.ei_id, '|', ei.ei_graduation_year ORDER BY ei.ei_graduation_year) as student FROM education_information ei ".
                                // 'join education_information ei on ue.ei_id = ei.ei_id '.
                               //  'join institution i on ei.inst_id = i.inst_id '.
                                 "JOIN course c on ei.course_id = c.course_id ".
                                 "JOIN institution_course ic on c.course_id = ic.course_id ".
                                 "JOIN institution i on ei.inst_id = i.inst_id ".
                                 'join university u on i.uni_id = u.uni_id '.
                                 "WHERE ei.ei_graduation_year BETWEEN ".$start." AND ".$end." ".
                               //  'WHERE ei.ei_graduation_year BETWEEN '.$start.' AND '.$end.' '.
                                 'AND u.uni_status = "1" '.
                                 'GROUP BY i.inst_id')
                  ->asArray()
                  ->all();

          return $user;
    }

    public static function getReportHome()
    {
      /*$data = User::findBySql("SELECT COUNT(ue.ei_id) as totalstudent, i.*,ei.ei_graduation_year FROM  us ".
                              "JOIN user_education ue on us.id=ue.id ".
                              "JOIN education_information ei on ue.ei_id = ei.ei_id ".
                              "JOIN institution i on ei.inst_id = i.inst_id ".
                              "JOIN university u on i.uni_id = u.uni_id ".
                              "WHERE ei.ei_graduation_year BETWEEN '2010' AND '2014' AND u.uni_status = '1' ".
                              "AND i.inst_status = '1' GROUP BY ei.inst_id,ei.ei_graduation_year")*/
$data = User::findBySql("SELECT COUNT(ei.ei_id) as totalstudent, i.*,ei.ei_graduation_year FROM university u ".
                        "JOIN institution i on u.uni_id = i.uni_id ".
                        "JOIN education_information ei on i.inst_id = ei.inst_id ".
                        "WHERE ei.ei_graduation_year BETWEEN '2010' AND '2014' AND u.uni_status = '1' ".
                        "AND i.inst_status = '1' GROUP BY ei.inst_id,ei.ei_graduation_year")
                  ->asArray()
                  ->all();

        return $data;
    }

    public static function getUserReport($start)
    {
       $user = User::findBySql("SELECT COUNT(ue.id) as totalstudent, pi.pi_gender FROM user_education ue ".
                               "join education_information ei on ue.ei_id = ei.ei_id ".
                               "join institution i on ei.inst_id = i.inst_id ".
                               "join university u on i.uni_id = u.uni_id ".
                               'join user us on ue.id = us.id '.
                               'join personal_information pi on us.pi_id = pi.pi_id '.
                               //'WHERE ei.ei_graduation_year = "'.$currentYear.'" '.
                               'WHERE ei.ei_graduation_year = '.$start.' '.
                               'AND u.uni_status = "1" '.
                               'GROUP BY pi.pi_gender')
                 ->asArray()
                 ->all();

        return $user;
    }

    public static function getStudent($start,$poscode)
    {
        $user = User::findBySql("SELECT pi.pi_name, pi.pi_id, wi.wi_company_name FROM personal_information pi " . 
                                "JOIN user u on pi.pi_id = u.pi_id ".
                                "JOIN user_education ue on u.id = ue.id ".
                                "JOIN education_information ei on ue.ei_id = ei.ei_id ".
                                "LEFT JOIN user_working uw on u.id = uw.id ".
                                "LEFT JOIN working_information wi on uw.wi_id = wi.wi_id ".
                                "WHERE ei.ei_graduation_year ='".$start."' ".
                                "AND pi.pi_zipcode ='".$poscode."'")
                 ->asArray()
                 ->all();

        return $user;
    }

    public static function getWorkingReport($start)
    {
       $user = User::findBySql("SELECT COUNT(ue.id) as totalstudent, us.working_status FROM user_education ue ".
                               "join education_information ei on ue.ei_id = ei.ei_id ".
                               "join institution i on ei.inst_id = i.inst_id ".
                               "join university u on i.uni_id = u.uni_id ".
                               'join user us on ue.id = us.id '.
                               'join personal_information pi on us.pi_id = pi.pi_id '.
                               //'WHERE ei.ei_graduation_year = "'.$currentYear.'" '.
                               'WHERE ei.ei_graduation_year = '.$start.' '.
                               'AND u.uni_status = "1" '.
                               'GROUP BY us.working_status')
                 ->asArray()
                 ->all();

        return $user;
    }
}
