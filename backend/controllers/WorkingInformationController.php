<?php

namespace backend\controllers;

use Yii;
use backend\models\WorkingInformation;
use backend\models\WorkingInformationSearch;
use backend\models\User;
use backend\models\UserWorking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * WorkingInformationController implements the CRUD actions for WorkingInformation model.
 */
class WorkingInformationController extends Controller
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

    /**
     * Lists all WorkingInformation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkingInformationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkingInformation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WorkingInformation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkingInformation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wi_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WorkingInformation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->wi_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WorkingInformation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WorkingInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkingInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkingInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function actionSaveworkingrecord()
    {
    
        $request = Yii::$app->request;
        $userID = $request->post('userID');
        $companyName = $request->post('companyname');
        $position = $request->post('position');
        $start = $request->post('start');
        $to = $request->post('serviceto');

        $model = new WorkingInformation();
        $userWorking = new UserWorking();
        $user = new User();
            /*print_r($this->pi_name);
            die();*/
            /*$pi = new PersonalInformation();
            $pi->load(Yii::$app->request->post());*/
            $model->wi_company_name = $companyName;
            $model->wi_position = $position;
            $model->wi_year_of_service_from = $start;
            $model->wi_year_of_service_to = $to;
            $model->save();

            /*print_r($model->save());
            die();*/
            if($model->save() == 1)
            {
                   
                    $userWorking->id = $userID;
                    $userWorking->wi_id = $model->wi_id;
                    $userWorking->save();
                    /*print_r($model->getErrors());
                    die();*/
                     Yii::$app->db->createCommand("UPDATE user SET working_status=2 WHERE id=$userID")
                    // ->bindValue(':id', your_id)
                     ->execute();
                   
            }

           // return $this->redirect(['index', 'id' => $model->id]);

        }
}
