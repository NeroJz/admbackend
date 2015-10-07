<?php

namespace backend\controllers;

use Yii;
//use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use api\modules\v1\models\User;
use backend\models\User;
use backend\models\Course;
//use yii\web\AssetBundle;
use backend\models\PersonalInformation;
use backend\models\Institution;
use backend\models\EducationLevel;
use backend\models\UserEducation;
use backend\models\EducationInformation;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

       // $training = Training::find()->where(array('id' => $id))->asArray()->one();
        //Yii::$app->response->format = 'json';
       // $dataProvider = User::getAllUsers();
      //  $data['userList'] = User::getAllUsers();
        //return $this->render('mainUser',$data);

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*print_r($dataProvider);
        die();*/
        return $this->render('mainUser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $data['userList'] = User::getAllUsers($id);
        $data['userEducation']  = User::getUserEducation($id);
        $data['userWorking']  = User::getUserWorking($id);
        $data['institution'] = Institution::find()->where(array('inst_status'=> 1))->all();
        $data['level'] = EducationLevel::find()->indexBy('el_id')->all();

        return $this->render('view', $data);

        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $pi = new PersonalInformation();
        if ($pi->load(Yii::$app->request->post())) {
            /*print_r($this->pi_name);
            die();*/
            /*$pi = new PersonalInformation();
            $pi->load(Yii::$app->request->post());*/
            $pi->pi_name = $pi->pi_name;
            $pi->save();


            if($pi->save() == 1)
            {
                   // this is inserted user id
                    //$model = new User();
                    $model->load(Yii::$app->request->post());
                    /*print_r($model);
                    //print_r($pi);
                    die();*/
                    $userID = $pi->pi_id;
                    $model->pi_id = $userID;
                    $model->username = $model->username;
                    $model->status = $model->status;
                    $model->online_status = "0";
                    $model->created_at = time();
                    $model->updated_at = time();
                    $model->auth_key = "vBZS7KGrvXesyOkgQhGYCY5KCZi6st5g";
                    $model->password_hash = "$2y$13$4cRqqw0nmEj5.NJRcJYaE.YUSh9DJaQsSpLM3OCicXckrCPoAgWYC";
                    $model->save();
                    /*print_r($model->getErrors());
                    die();*/
                   
            }

            return $this->redirect(['index', 'id' => $model->id]);
         
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $data['userList'] = User::getAllUsers($id);
        return $this->render('update', $data);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      
        $user = User::find()->where(array('id'=> $id))->one();
        /*$user->username = $request->post("username");
        $user->status = $request->post("userstatus");*/
        $user->status = 20;
        $user->update();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTest()
    {
        
        $request = Yii::$app->request;
        $userID = $request->post('userID'); 
        $data['login_information'] = User::getUserInfo($userID);
        $data['PersonalInformation'] = PersonalInformation::getUserPersonalInfo($userID);
        //print_r($data['login_information']);
        Yii::$app->response->format = 'json';//header json
        echo json_encode($data);
    }

    public static function actionSaveupdate()
    {
        $request = Yii::$app->request;
        $userID = $request->post('userID'); 
        $piID = $request->post('piID'); 

        $user = User::find()->where(array('id'=> $userID))->one();
        $user->username = $request->post("username");
        $user->status = $request->post("userstatus");
        $user->updated_at = time();
        $user->update();
        //$user->auth_key = "vBZS7KGrvXesyOkgQhGYCY5KCZi6st5g";
       // $user->password_hash = "$2y$13$4cRqqw0nmEj5.NJRcJYaE.YUSh9DJaQsSpLM3OCicXckrCPoAgWYC";
        
        $personalinfo = PersonalInformation::find()->where(array('pi_id'=> $piID))->one();
        $personalinfo->pi_name = $request->post("fullname");
        $personalinfo->pi_address_permanent = $request->post("permanentaddress");
        $personalinfo->pi_zipcode_permanent = $request->post("permanentzipcode");
        $personalinfo->pi_address = $request->post("address");
        $personalinfo->pi_zipcode = $request->post("zipcode");
        $personalinfo->pi_ic_or_passport = $request->post("icno");
        $personalinfo->pi_gender = $request->post("gender");
        $personalinfo->pi_phone_home = $request->post("phone");
        $personalinfo->pi_hp = $request->post("handphone");
        $personalinfo->pi_email_1 = $request->post("email_1");
        $personalinfo->pi_email_2 = $request->post("email_2");
        $personalinfo->update();
        // print_r($user->update());
       /*  print_r($personalinfo->getErrors());
         die();*/

        
    }

    public static function actionDeleteuserinfo()
    {
        $request = Yii::$app->request;
        $userID = $request->post('userID');
        $data = User::updateStatus($userID);

        //alert("Data Berjaya dipadam");

        return $this->redirect(['index']);
    }

    public static function actionViewuser()
    {

        $request = Yii::$app->request;
        $userID = $request->post('userID');
        $data = User::getUserEducation($userID);

        Yii::$app->response->format = 'json';//header json
        echo json_encode($data);

    }

    public static function actionUpdateeducation()
    {
        $request = Yii::$app->request;
        $updateFactID = $request->post('update_fact_name');
        $updateLevel = $request->post('update_level');
        $updateYear = $request->post('update_year');
        $updateCourse = $request->post('update_course_name');
        $id = $request->post('id');
       
        $updateUser = User::UpdateRecordEducation($id,$updateFactID,$updateCourse,$updateLevel,$updateYear);
        return 1;

    }

    public static function actionGetcourse()
    {
        $request = Yii::$app->request;
        $factID = $request->post('factID');
        $data = Course::getCourseByFaculty($factID);
        
        Yii::$app->response->format = 'json';//header json
        echo json_encode($data);
    }

    public function actionSaveneweducation()
    {
        
        $request = Yii::$app->request;
        $updateFactID = $request->post('fact_name');
        $updateLevel = $request->post('level');
        $updateYear = $request->post('year');
        $updateCourse = $request->post('course_name');
        $uniID = $request->post('uni_id');
        $id = $request->post('stuid');

        $ei = new UserEducation();
        $model = new EducationInformation();

            $model->inst_id = $updateFactID;
            $model->course_id = $updateFactID;
            $model->el_id = $updateLevel;
            $model->ei_graduation_year = $updateYear;
            $model->save();


            if($model->save() == 1)
            {

                    $ei->load(Yii::$app->request->post());

                    $userID = $model->ei_id;
                    $ei->ei_id = $userID;
                    $ei->id = $id;
                    $ei->ue_status = 1;
                    $ei->save();

                   
            }

    }


}
