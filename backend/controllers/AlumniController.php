<?php

namespace backend\controllers;

use Yii;
use backend\models\Alumni;
use backend\models\AlumniSearch;
use backend\models\InstitutionCourse;
use backend\models\EducationLevel;
use backend\models\PersonalInformation;
use backend\models\User;
use backend\models\EducationInformation;
use backend\models\UserEducation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseUrl;
use yii\helpers\ArrayHelper;

/**
 * AlumniController implements the CRUD actions for Alumni model.
 */
class AlumniController extends Controller
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
     * Lists all Alumni models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlumniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGenerate(){
        $model = Alumni::find()
        //->where(['IN', 'e_kp', ['880214565399','870507015025','880906355448','880722435283','B153796']])
        ->asArray()->all();
        $counter = 0;

        foreach ($model as $rA) {
            $course_name = $rA['e_program'];
            $ei_graduation_year = $rA['e_tahun_tamat'];

            $pi_name = $rA['e_nama'];
            $pi_ic_or_passport = $rA['e_kp'];
            $pi_gender = $rA['e_jantina'];
            $pi_address = $rA['e_alamat'];
            $pi_zipcode = $rA['e_poskod'];
            $pi_address_permanent = $rA['e_alamat_tetap'];
            $pi_zipcode_permanent = $rA['e_poskod_tetap'];
            $pi_phone_home = $rA['e_tel_rumah'];
            $pi_hp = $rA['e_tel_hp'];
            $pi_email_1 = $rA['e_emel1'];
            $pi_email_2 = $rA['e_emel2'];

            $AlumniCur = User::find()
                            ->select(['user.id','user.pi_id','user_education.*','course.*'])
                            ->joinWith(['pi','userEducations','educationInformation','course'])
                            ->where(['pi_ic_or_passport' => $pi_ic_or_passport])
                            ->asArray()->all();

            if((sizeof($AlumniCur) > 0) and $AlumniCur[0]['course']['course_name'] == $course_name)
            {
                continue;
            }

            $mdlCourse = InstitutionCourse::find()
                            ->joinWith(['course'])
                            ->where(['course_name' => $course_name])
                            ->asArray()->all();

            $aCourse = sizeof($mdlCourse)>0?$mdlCourse[0]:[];

            if(sizeof($aCourse) > 0){
                $course_id = $aCourse['course_id'];
                $inst_id = $aCourse['inst_id'];
                $aLevel_code = explode(" ", $course_name);
                $el_code = $aLevel_code[0];

                //check if education information already registered
                $mdlEduInfo = EducationInformation::find()
                                ->where(['course_id' => $course_id,
                                            'inst_id' => $inst_id,
                                            'ei_graduation_year' => $ei_graduation_year])
                                ->asArray()->all();

                $mdlEducationLevel = EducationLevel::find()
                                        ->where(['el_name' => $el_code])
                                        ->asArray()->all();

                $aEL = sizeof($mdlEducationLevel)>0?$mdlEducationLevel[0]:[];

                $el_id = $aEL['el_id'];
            }

            $pi = new PersonalInformation();
            $usr = new User();

            //let's insert the data to database
            if(sizeof($AlumniCur) == 0){                
                $pi->pi_name = $pi_name;
                $pi->pi_ic_or_passport = $pi_ic_or_passport;
                $pi->pi_gender = $pi_gender;
                $pi->pi_address = $pi_address;
                $pi->pi_zipcode = $pi_zipcode;
                $pi->pi_address_permanent = $pi_address_permanent;
                $pi->pi_zipcode_permanent = $pi_zipcode_permanent;
                $pi->pi_phone_home = $pi_phone_home;
                $pi->pi_hp = $pi_hp;
                $pi->pi_email_1 = $pi_email_1;
                $pi->pi_email_2 = $pi_email_2;
                $pi->save();

                $cost = 10;
                $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
                $salt = sprintf("$2a$%02d$", $cost) . $salt;

                $hash = crypt('demo', $salt);
               
                $usr->pi_id = $pi->pi_id;
                $usr->username = $pi_ic_or_passport;
                $usr->auth_key = 'vBZS7KGrvXesyOkgQhGYCY5KCZi6st5g';
                $usr->password_hash = $hash;
                $usr->created_at = time();
                $usr->updated_at = time();
                $usr->save();
            }else{
                $usr->id = $AlumniCur[0]['id'];
            }

            if(sizeof($aCourse) == 0)
                continue;

            $ei = new EducationInformation();

            if(sizeof($mdlEduInfo) == 0){
               
                $ei->inst_id = $inst_id;
                $ei->course_id = $course_id;
                $ei->el_id = $el_id;
                $ei->ei_graduation_year = $ei_graduation_year;
                $ei->save();
            }else{
                $ei->ei_id = $mdlEduInfo[0]['ei_id'];
            }

            $ue = new UserEducation();
            $ue->id = $usr->id;
            $ue->ei_id = $ei->ei_id;
            $ue->save();
            
            //dpo: break to test one data only
            //break;


        }
    }

    /**
     * Displays a single Alumni model.
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
     * Creates a new Alumni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alumni();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->alumni_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Alumni model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->alumni_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Alumni model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    //test function
    public function actionTestJoin(){

        //Yii::$app->message->display('I am Yii2.0 Programmer');
        echo Yii::$app->params['hostID'];

        $items = User::find()
        ->joinWith(['pi' => function($q){
         $q->from(PersonalInformation::tableName().' p');
     }])
        ->with(['userEducations' => function($q) {
            $q->select(['id','ue_id','ei_id']);
        }])
        ->select(['{{user}}.pi_id','id', 'username', 'password_hash', 'p.pi_name'])
        ->where(['IN', 'pi_ic_or_passport', ['880214565399','870507015025','880906355448','880722435283','B153796']])
        ->asArray()
        ->all();

        //print_r($items);
    }

    /**
     * Finds the Alumni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alumni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumni::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
