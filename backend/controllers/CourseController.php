<?php

namespace backend\controllers;
use Yii;
use backend\models\Course;
use backend\models\University;
use backend\models\Institution;
use backend\models\InstitutionCourse;
use backend\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class CourseController extends Controller
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
     * Lists all EducationLevel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EducationLevel model.
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
     * Creates a new EducationLevel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $fact_id =   Yii::$app->getRequest()->getQueryParam('id');//ambil id dkat parameter
       /* print_r($fact_id);
        die();*/
        $data['university'] = "";
        $data['hasRecord'] = "";

        if(empty($fact_id))
        {
            $data['university'] = University::find()->indexBy('uni_id')->asArray()->all();
            $data['hasRecord'] = 0;
        }
        else
        {
            $data['university'] = Institution::getUniFaculty($fact_id);
            $data['hasRecord'] = 1;
        }
        
        return $this->render('create',$data);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->course_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Updates an existing EducationLevel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->course_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EducationLevel model.
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
     * Finds the EducationLevel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EducationLevel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function actionGetfaculty()
    {
        $request = Yii::$app->request;
        $uni_ID = $request->post('uni_id'); 
        $data = Institution::find()->where(array('uni_id'=> $uni_ID))->asArray()->all();
        Yii::$app->response->format = 'json';//header json
        echo json_encode($data);
        
    }

    public static function actionSavecourse()
    {
        $request = Yii::$app->request;
        $sizePost = sizeof($_POST);
        $lengthData = ($sizePost - 2)/2;
        
        /*print_r($_POST);
        die();*/
        //fact_id
        for ($i=1; $i <= $lengthData ; $i++) { 
            
            $model = new Course();
            $model->course_name = $request->post('course_'.$i.'');
            $model->course_code = $request->post('courseCode_'.$i.'');
            $model->course_status = 1;
            $model->save();

                if($model->save() == 1)
                {
                    $modelie = new InstitutionCourse();
                    $modelie->inst_id = $request->post('fact_id');
                    $modelie->course_id= $model->course_id;
                    $modelie->save();
                }
          /*  print_r($model->getErrors());
            die();*/

        }
    }
}
