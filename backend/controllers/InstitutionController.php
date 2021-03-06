<?php

namespace backend\controllers;

use Yii;
use backend\models\Institution;
use backend\models\InstitutionSearch;
use backend\models\University;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstitutionController implements the CRUD actions for Institution model.
 */
class InstitutionController extends Controller
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
     * Lists all Institution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InstitutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Institution model.
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
     * Creates a new Institution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Institution();
        $uni_id =   Yii::$app->getRequest()->getQueryParam('id');//ambil id dkat parameter
        $data['university'] = "";
        $data['hasRecord'] = "";
        if(empty($uni_id))
            {
                $data['university'] = University::find()->indexBy('uni_id')->asArray()->all();
                $data['hasRecord'] = 0;
            }
        else
            {
                //print_r($uni_id);$user = User::find()->->one();
                $data['university'] = University::find()->where(array('uni_id'=> $uni_id))->asArray()->all();
                $data['hasRecord'] = 1;
            }
    
       
        $data['model'] = $model;

        return $this->render('create',$data);
        /*print_r($university);
        die();*/
       /* if ($model->load(Yii::$app->request->post())) {
           
           return $this->render('create', [
               'model' => $model,
               'university' => $data,
           ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Updates an existing Institution model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->inst_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Institution model.
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
     * Finds the Institution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Institution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Institution::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function actionSaverecord()
    {
        $request = Yii::$app->request;
        
       /* print_r($_POST);
        die();*/
            
            $sizePost = sizeof($_POST);
            $lengthData = ($sizePost - 2)/2;

            for ($i=1; $i <= $lengthData ; $i++) { 
                
                $model = new Institution();
                $model->inst_name = $request->post('fact_'.$i.'');
                $model->inst_code = $request->post('factCode_'.$i.'');
                $model->uni_id = $request->post('uni_id');
                $model->save();
                /*print_r($model->getErrors());
                die();*/

            }
    }
}
