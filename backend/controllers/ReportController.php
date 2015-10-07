<?php

namespace backend\controllers;
use yii;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;
use backend\models\PersonalInformation;
use backend\models\State;
use backend\models\Institution;
use backend\models\Course;
//use backend\models\University;


class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data['faculty'] = Institution::find()
                           ->select(['inst_id','inst_name','inst_code','institution.uni_id'])
                           ->joinWith(['university'])
                           ->where(['uni_status' => 1])
                           ->asArray()->all();
      //  $data['faculty'] = Institution::find()->indexBy('inst_id')->where(array('id'=> $id))->asArray()->all();
        return $this->render('index',$data);
    }

    public static function actionGetReport()
    {
    	$request = Yii::$app->request;
    	$type = $request->post('type'); 
        $start = $request->post('start'); 
        $end = $request->post('end');
    	$data = "";

    	if($type == "Negeri")
    	{
    		$data['currentYear'] = State::getStateReport();
            $data['rangeYear'] = State::getStateReportRange();
          /*  print_r($data);
            die();*/
    	}
    	else if($type == "Faculty")
    	{
    		$faculty = Institution::getFacultyReport($start,$end);

            $facultyDetailData = array();
            
           
            foreach ($faculty as $facultyData) {
                $dataArray = array();
                $dataSplit = explode(",",$facultyData['student']);

                $facultyDetailData[$facultyData['inst_id']]["facultyName"] = $facultyData['inst_name'];
                $facultyDetailData[$facultyData['inst_id']]["facultyCode"] = $facultyData['inst_code'];
                
               for ($i=0; $i < sizeof($dataSplit) ; $i++) { 
                   $dataSplitDetail =  explode("|",$dataSplit[$i]);
                   /*print_r($dataSplitDetail);
                   die();*/
                   //$facultyDetailData[$facultyData['inst_id']][] = isset($dataSplitDetail[1])?$dataSplitDetail[1]:'';
                   $dataArray[$facultyData['inst_id']][] = isset($dataSplitDetail[1])?$dataSplitDetail[1]:'';
               }

                     $occurences = array();
                foreach ($dataArray as $key) {
                    //print_r($key);
                    $occurences = array_count_values($key);
                    $facultyDetailData[$facultyData['inst_id']]['count'][] = $occurences;
                   //print_r($occurences);

                }
               
            }

            $data = $facultyDetailData;//inst_id 
/*            print_r($data);
           
            die();*/
    	}
        else if($type == "Course")
        {
            $occurences = array();
            $factID = $request->post('fact_id');
            $course = Course::getCourseReport($factID,$start,$end);
            /*print_r($course);
            die();*/

            $courseDetailData = array();
            $bil2 = 1;
            $sizecourse = sizeof($course);
            foreach ($course as $courseData) {

                $dataCourseArray = array();
                $dataCourseSplit = explode(",",$courseData['students']);

                $courseDetailData[$bil2]["courseName"] = $courseData['course_name'];
                $courseDetailData[$bil2]["courseCode"] = $courseData['course_code'];
                $courseDetailData[$bil2]["size"] = $sizecourse;

                for ($i=0; $i < sizeof($dataCourseSplit); $i++) { 
                    $dataSplitDetail =  explode("|",$dataCourseSplit[$i]);
                   // $courseDetailData[$courseData['course_id']][] = $dataCourseSplitDetail[1];
                    $dataCourseArray[$bil2][] = isset($dataSplitDetail[1])?$dataSplitDetail[1]:'';
                }
                

                     $occurences = array();
                foreach ($dataCourseArray as $key) {
                    //print_r($key);
                    $occurences = array_count_values($key);
                    $courseDetailData[$bil2]['count'][] = $occurences;

                   //print_r($occurences);

                }
                $bil2++;
            }
            $courseDetailData[$bil2]['count'][] = $occurences;
            $data =  $courseDetailData;
            
        }
        else if($type == "Jantina")
        {
            $data = Institution::getUserReport($start);
        }

        else if($type == "work")
        {
            $data = Institution::getWorkingReport($start);
        }

    	Yii::$app->response->format = 'json';//header json
    	echo json_encode($data);
    }

}
