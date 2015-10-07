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

class StatisticController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userpointarray = PersonalInformation::getUserPosition();
        $State = State::find()->indexBy('s_id')->asArray()->all();
        //Yii::$app->response->format = 'json';// klu nk convert smue data jdi json
        $data['userpoint'] =  json_encode($userpointarray);
        $data['state'] = $State;
        return $this->render('index',$data);
    }

    public function actionGetStatisctic()
    {
    	$request = Yii::$app->request;
    	$year = $request->post('year');
        $state = $request->post('negeri');
        $data['centerPoint'] = State::getPoint($state);
    	$data['userpointarray'] = PersonalInformation::getUserPositionByYear($year);
    	Yii::$app->response->format = 'json';// klu nk convert smue data jdi json
    	echo json_encode($data); 
    }

    public function actionGetStudent()
    {
        $request = Yii::$app->request;
        $year = $request->post('year');
        $poscode = $request->post('zipcode');

        $SearchStudent = Institution::getStudent($year,$poscode);
        /*print_r($SearchStudent);
        die();*/
        Yii::$app->response->format = 'json';// klu nk convert smue data jdi json
        echo json_encode($SearchStudent); 

    }

}
