<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\State;
use backend\models\Institution;
use backend\models\EducationLevel;
use backend\models\Course;

class AdvancedSearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data['state'] = State::find()->indexBy('s_id')->asArray()->all();
        $data['Faculty'] = Institution::getCurrentFaculty();
        $data['level'] = EducationLevel::find()->indexBy('el_id')->asArray()->all();
        $data['course'] = Course::find()->indexBy('course_id')->asArray()->all();
        return $this->render('index',$data);
    }

    public static function actionGetCourse()
    {
        $request = Yii::$app->request;
        $factID = $request->post('fact_id'); 
        
        $data = Course::getCourseName($factID);

        Yii::$app->response->format = 'json';//header json
        echo json_encode($data);
        /*print_r($data['coursename']);
        die();*/
    }

    public function actionGetAdvancedReport()
    {
        /*$data["test"] = "lala";
        print_r($_POST);
        die();*/
        $request = Yii::$app->request;
        $state = $request->post('state');
        $race = $request->post('race');
        $age = $request->post('age');
        $gender = $request->post('gender');
        //education
        $advFaculty = $request->post('advFaculty');
        $advCourse = $request->post('advCourse');
        $level = $request->post('level');
        $year = $request->post('year');

        //occupation
        $stateWork = $request->post('stateWork');
        $workstatus = $request->post('workstatus');
        $position = $request->post('workposition');

        $data['student'] = State::getResultAdvancedReport($state,$race,$age,$gender,$advFaculty,$advCourse,$level,$year,$stateWork,$workstatus,$position);

        /*print_r($data['student']);
        die();*/
        return $this->render('viewReport',$data);

    }

}
