<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use api\modules\v1\models\Institution;
use api\modules\v1\models\EducationLevel;
use api\modules\v1\models\EducationInformation;
use api\modules\v1\models\University;
use api\modules\v1\models\UserEducation;
use api\modules\v1\models\InstitutionCourse;
use api\modules\v1\models\Course;
use yii\db\Query;


class InstitutionController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Institution';

    public function actionGetallinstitution(){

    		$Institution = new Institution();
		$Institution = Institution::findAll(['inst_status'=>1]);
		return $Institution;
    }

    public function actionGetalluniversities(){

        $uni = new University();
    $uni = University::findAll([
    'uni_status' => 1,
    ]);
    return $uni;
    }

    public function actionInserteducation(){

    }

    public function actionGetedulevel(){
    	$Edulevel = new EducationLevel();
		$Edulevel = EducationLevel::find()->all();
		return $Edulevel;
    }

      public function actionGetallcourse(){
    	$course = new Course();
		$course = Course::findAll(['course_status'=>1]);
		return $course;
    }

    public function actionInserteducationinfo(){
    	//insert to education_information table, then the id need to be inserted to user_education
    	 $model = new EducationInformation();
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $result=\Yii::$app->getRequest()->getBodyParams();


         //$model->uni_id=$result['uni_id'];
         $model->inst_id=$result['inst_id'];
         $model->course_id=$result['course_id'];
         $model->el_id=$result['el_id'];
         $model->ei_graduation_year=$result['ei_graduation_year'];

         //check if existing course is linked with the institution
         $institution_course=new InstitutionCourse;
         $institution_course=InstitutionCourse::find()->where(
          [
          'course_id' => $result['course_id'],
          'inst_id'=>$result['inst_id']

          ])->one();

         if(!$institution_course || $institution_course==null)
         {
          //add insitution course
          $inst_course=new InstitutionCourse;
          $inst_course->inst_id=$result['inst_id'];
          $inst_course->course_id=$result['course_id'];
          $inst_course->save();

         }

       if($model->save()){
          $ei_id=$model->ei_id;

          $user_id=$result['user_id'];

           $useredu = new UserEducation();
           $useredu->id=$user_id;
           $useredu->ei_id=$ei_id;

           if($useredu->save()){
               return $useredu;
           }

       }

      }

    }

    public function actionInsertusereducationinfo(){
        $model = new EducationInformation();
        $university = new University();
        $institution = new Institution();
        $course = new Course();

        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
            $input=\Yii::$app->getRequest()->getBodyParams();

            //Insert new University if it does not existed
            if(!isset($input['uni_id']) || $input['uni_id'] == null){
                $university = new University();
                $university->uni_name = $input['uni_name'];
                $university->uni_status = 1;

                if($university->save()){
                    $input['uni_id'] = $university->uni_id;
                }
            }

            //Insert new Institution if it does not existed
            if(!isset($input['inst_id']) || $input['inst_id'] == null){
                $institution = new Institution();
                $institution->inst_name = $input['inst_name'];
                $institution->uni_id = $input['uni_id'];
                $institution->inst_status = 1;

                if($institution->save()){
                    $input['inst_id'] = $institution->inst_id;
                }
            }

            //Insert new course if it does not existed
            if(!isset($input['course_id']) || $input['course_id'] == null){
                $course = new Course();
                $course->course_name = $input['course_name'];
                $course->course_status = 1;

                if($course->save()){
                    $input['course_id'] = $course->course_id;

                    $inst_course = new InstitutionCourse();
                    $inst_course->course_id = $input['course_id'];
                    $inst_course->inst_id = $input['inst_id'];

                    $inst_course->save();
                }
            }

            $edu_information = EducationInformation::find()->where(
                array(
                    'inst_id' => $input['inst_id'],
                    'course_id' => $input['course_id'],
                    'el_id' => $input['el_id'],
                    'ei_graduation_year' => $input['ei_graduation_year']
                )
            )->one();

            if(!$edu_information || $edu_information == null){
                $model->inst_id = $input['inst_id'];
                $model->course_id = $input['course_id'];
                $model->el_id = $input['el_id'];
                $model->ei_graduation_year = $input['ei_graduation_year'];

                if($model->save()){
                    $input['ei_id'] = $model->ei_id;
                }
            }else{
                $input['ei_id'] = $edu_information->ei_id;
            }

            $user_edu = new UserEducation();
            $user_edu->id = $input['pi_id'];
            $user_edu->ei_id = $input['ei_id'];
            $user_edu->save();

            return $user_edu;

        }
    }

    /**********************************************
     * Description: delete education
     * Author: Jz
     * Date: 28/09/2015
     * @return model
     */
    public function actionDeleteeducationinfo(){
        $ue_id = \Yii::$app->request->post('ue_id');

        $model = UserEducation::findOne($ue_id);

        if($model->delete()){
            return $model;
        }else{
            return $model;
        }
    }

    public function actionAddnewuniversity(){
        $model = new University();
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $uni_text=\Yii::$app->getRequest()->getBodyParams();

         $model->uni_name=$uni_text;
         $model->uni_code=$uni_text;
         $model->uni_status=0;

         if($model->save()){
          return $model->uni_id;
        }

       }

    }

      public function actionAddnewinstitution(){
        $model = new Institution();
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $result=\Yii::$app->getRequest()->getBodyParams();

         $model->inst_code="NONE";
         $model->inst_name=$result['inst_text'];
         $model->uni_id=$result['uni_id'];
         $model->inst_status=0;

         if($model->save()){
          return $model->inst_id;
        }

       }

    }

      public function actionAddnewcourse(){
        $model = new Course();
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $result=\Yii::$app->getRequest()->getBodyParams();

         $model->course_code="UNKNOWN";
         $model->course_name=$result;
         $model->course_status=0;

         if($model->save()){
          return $model->course_id;
        }

       }

    }



}
