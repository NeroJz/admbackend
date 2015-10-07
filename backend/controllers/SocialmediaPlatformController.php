<?php

namespace backend\controllers;

use Yii;
use backend\models\SocialMediaPlatform;
use backend\models\SocialmediaPlatformSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseUrl;


/**
 * SocialmediaPlatformController implements the CRUD actions for SocialmediaPlatform model.
 */
class SocialmediaPlatformController extends Controller
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
     * Lists all SocialmediaPlatform models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SocialmediaPlatformSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Displays a single SocialmediaPlatform model.
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
     * Creates a new SocialmediaPlatform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SocialMediaPlatform();

        if ($model->load(Yii::$app->request->post())) {
          /*print_r($model);
          die();*/
          $model->sp_name = $model->sp_name;
          $model->sp_description = $model->sp_description;
          $model->save();
          
            return $this->redirect(['view', 'id' => $model->sp_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

       /* if ($model->load(Yii::$app->request->post())) {
          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          $save_file = '';


          if($model->imageFile){
                    $imagepath = 'uploads/socialmedia_image/'; // Create folder under web/uploads/logo
                    $model->sp_logo = $imagepath .rand(10,100).'-'.$model->imageFile->name;
                    $save_file = 1;
                 //print_r($model->sp_logo); die();
                }

                if ($model->save()) {
                    if($save_file){
                        $model->imageFile->saveAs($model->sp_logo);
                    }
                    return $this->redirect(['view', 'id' => $model->sp_id]);
                } 


            } else {
                return $this->render('create', [
                    'model' => $model,
                    ]);
            }*/
        }

    /**
     * Updates an existing SocialmediaPlatform model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

              $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $save_file = '';

               

                if($model->imageFile){
                    $imagepath = 'uploads/socialmedia_image/';
                    $model->sp_logo = $imagepath .rand(10,100).'-'.$model->imageFile->name;
                    $save_file = 1;
                }


                if ($model->save()) {

                    if($save_file){
                            $model->imageFile->saveAs($model->sp_logo);
                        }
                   return $this->redirect(['view', 'id' => $model->sp_id]);
                } 
                else
                {
                    // print_r($model->errors); die();
                }

            
        } else {
            return $this->render('update', [
                'model' => $model,
                ]);
        }
    }

    public function actionDeleting($id,$field){
$field="sp_logo";

          $img = $this->findModel($id)->$field;
        
        if($img){
            if (!unlink($img)) {
            return false;
        }
    }

        $img2 = $this->findModel($id);

        $img2->$field = NULL;
        
        $img2->save();
    
        return $this->redirect(['update', 'id' => $id]);
       
        //unlink(getcwd().'/uploads/'.$model->file_id.'/'.$fileModel->file_name.$fileModel->extension);
    }

    public function actionUpload()
    {
        $model = new SocialmediaPlatform();

        if (Yii::$app->request->isPost) {
            $model->sp_logo = UploadedFile::getInstance($model, 'sp_logo');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Deletes an existing SocialmediaPlatform model.
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
     * Finds the SocialmediaPlatform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SocialmediaPlatform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SocialmediaPlatform::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
