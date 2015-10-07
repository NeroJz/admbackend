<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $s_id
 * @property string $s_name
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name'], 'required'],
            [['s_name'], 'string', 'max' => 220]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's_id' => 'S ID',
            's_name' => 'S Name',
        ];
    }

    public function getStateReport()
    {
        $currentYear = date('Y',time()) - 1;
        $user = User::findBySql("SELECT COUNT(ue.id) as totalstudent, s.* FROM institution i join university u on i.uni_id = u.uni_id ".
                                'join education_information ei on i.inst_id = ei.inst_id '.
                                'join user_education ue on ei.ei_id = ue.ue_id '.
                                'join user us on ue.id = us.id '.
                                'join personal_information pi on us.pi_id = pi.pi_id '.
                                'join region r on pi.pi_zipcode = r.r_zipcode '.
                                'join state s on r.s_id = s.s_id '.
                                'WHERE ei.ei_graduation_year = "'.$currentYear.'" '.
                                //'WHERE ei.ei_graduation_year BETWEEN '.$start.' AND '.$end.' '.
                                'AND u.uni_status = "1" '.
                                'GROUP BY s.s_id')
                 ->asArray()
                 ->all();

        return $user;

    }

    public function getStateReportRange()
    {
        $currentYear = date('Y',time()) - 1;
        $startYear = $currentYear - 5;
        $user = User::findBySql("SELECT COUNT(ei.ei_id) as totalstudent, s.* FROM user_education ue ".
                                'JOIN education_information ei on ue.ei_id = ei.ei_id '.
                                'JOIN institution i on ei.inst_id = i.inst_id '.
                                'JOIN university uni on i.uni_id = uni.uni_id '.
                                'JOIN user u on ue.id = u.id '.
                                'JOIN personal_information pi on u.pi_id = pi.pi_id '.
                                'JOIN region r on pi.pi_zipcode = r.r_zipcode '.
                                'JOIN state s on r.s_id = s.s_id '.
                                //'WHERE ei.ei_graduation_year = "'.$currentYear.'" '.
                                'WHERE ei.ei_graduation_year BETWEEN '.$startYear.' AND '.$currentYear.' '.
                                'AND uni.uni_status = "1" '.
                                'GROUP BY s.s_id')
                 ->asArray()
                 ->all();

        return $user;
    }

    public static function getPoint($s_id)
    {
        $user = 0;
        if($s_id != 0)
        {
            $user = User::findBySql("SELECT r.r_geo_point, s.s_zoom_level from region r ".
                                    "JOIN state s on r.s_id = s.s_id ".
                                    "WHERE s.s_id ='".$s_id."' ".
                                    "AND r.r_capital ='1'")
                     ->asArray()
                     ->all();

        }
       
        return $user;

    }

    public static function getResultAdvancedReport($s_id,$race,$age,$gender,$advFaculty,$advCourse,$level,$year,$stateWork,$workstatus,$position)
    {
       $student = "";
       $condition = "";
       
       $joinRegion = "";

       if($s_id != 0)
       {
          $condition .= "AND s.s_id ='".$s_id."' ";
          $joinRegion .= "pi.pi_zipcode_permanent = r.r_zipcode";
       }

       if($race != 0)
       {
          $condition .= "AND pi.pi_race ='".$race."' ";
       }

       if($age != 0)
       {
          $currentYear = date('Y',time());

       
          if($age == "20-25")
          {
              $firstYear = $currentYear - 20;
              $lastYear = $currentYear - 25;

              $result1 = substr($firstYear, 2, 4);
              $result2 = substr($lastYear, 2, 4);
             
              $condition .= "AND SUBSTRING(pi.pi_ic_or_passport ,1,2)<= '".$result1."' AND SUBSTRING(pi.pi_ic_or_passport ,1,2) >= '".$result2."' ";

         }
          else if($age == "26-30")
          {
              $firstYear = $currentYear - 26;
              $lastYear = $currentYear - 30;

              $result1 = substr($firstYear, 2, 4);
              $result2 = substr($lastYear, 2, 4);
         
               $condition .= "AND SUBSTRING(pi.pi_ic_or_passport ,1,2)<= '".$result1."' AND SUBSTRING(pi.pi_ic_or_passport ,1,2) >= '".$result2."' ";
          }
          else if($age == "31-35")
          {
              $firstYear = $currentYear - 31;
              $lastYear = $currentYear - 35;

              $result1 = substr($firstYear, 2, 4);
              $result2 = substr($lastYear, 2, 4);
             
               $condition .= "AND SUBSTRING(pi.pi_ic_or_passport ,1,2)<= '".$result1."' AND SUBSTRING(pi.pi_ic_or_passport ,1,2) >= '".$result2."' ";
          }
          else if($age == "36-40")
          {
            $firstYear = $currentYear - 36;
            $lastYear = $currentYear - 40;

            $result1 = substr($firstYear, 2, 4);
            $result2 = substr($lastYear, 2, 4);
           
             $condition .= "AND SUBSTRING(pi.pi_ic_or_passport ,1,2)<= '".$result1."' AND SUBSTRING(pi.pi_ic_or_passport ,1,2) >= '".$result2."' ";

          }
          else if($age == "41")
          {
            $firstYear = $currentYear - 41;

            $result1 = substr($firstYear, 2, 4);
     
            $condition .= "AND SUBSTRING(pi.pi_ic_or_passport ,1,2) <= '".$result1."'";

          }

       }

       if($gender != null)
       {
          $condition .= "AND pi.pi_gender ='".$gender."' ";
       }

       if($advFaculty != 0)
       {
          $condition .= "AND ei.inst_id ='".$advFaculty."' ";
       }

       if($advCourse != 0)
       {
          $condition .= "AND ei.course_id ='".$advCourse."' ";
       }

       if($level != 0)
       {
          $condition .= "AND ei.el_id ='".$level."' ";
       }

       if($year != 0)
       {
          $condition .= "AND ei.ei_graduation_year ='".$year."' ";
       }

       if($workstatus !=null)
       {
          $condition .= "AND u.working_status ='".$workstatus."' ";
       }
       if($position != "")
       {
          $condition .= "AND wi.wi_position LIKE'%".$position."%' ";
       }
       if($stateWork != 0)
       {
          if($s_id == 0)
          {
            $joinRegion .= "pi.pi_zipcode_permanent = r.r_zipcode";
          }
          else
          {
            $joinRegion .= " OR pi.pi_zipcode = r.r_zipcode";
          }

          $condition .= "AND s.s_id ='".$stateWork."' ";
       }

         $student = User::findBySql("SELECT DISTINCT pi.*, u.id from personal_information pi ".
                                   "JOIN user u on pi.pi_id = u.pi_id ".
                                   "LEFT JOIN user_working uw on uw.id = u.id ".
                                   "LEFT JOIN working_information wi on uw.wi_id = wi.wi_id ".
                                   "JOIN user_education ue on u.id = ue.id ".
                                   "JOIN education_information ei on ue.ei_id = ei.ei_id ".
                                   "JOIN region r on ".$joinRegion." ".
                                   "JOIN state s on r.s_id = s.s_id ".
                                   "WHERE 1=1 ".$condition)
                    ->asArray()
                    ->all();
        
        return $student;

    }
}
