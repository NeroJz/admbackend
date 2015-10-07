<?php

namespace backend\Controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SocialMedia1Controller extends Controller
{
	public function behaviors()
	{
	    return [
	        'verbs' => [
	            'class' => VerbFilter::className(),
	            'actions' => [
	                'delete' => ['post'],
	            ],
	        ],
	    ];
	}

	public function actionIndex()
	{
	   // $searchModel = new SocialmediaSearch();
	    //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    /*return $this->render('index', [
	        'searchModel' => $searchModel,
	        'dataProvider' => $dataProvider,
	    ]);*/
	    echo "home";
	}
}

?>