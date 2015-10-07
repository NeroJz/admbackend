<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Certification;
use api\modules\v1\models\Course;
use api\modules\v1\models\EducationLevel;
use api\modules\v1\models\University;
use yii\rest\ActiveController;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\EducationInformation;
use api\modules\v1\models\User;
use api\modules\v1\models\SocialmediaPlatform;
use api\modules\v1\models\SocialMedia;
use api\modules\v1\models\UserSocialmedia;
use api\modules\v1\models\Institution;
use api\modules\v1\models\UserSocialmediaQuery;
use yii\db\Query;


class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';


    public function actionLogin()
    {

        $model = new LoginForm();
        $user = new User();
        $pi_id = 0;

        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            $result = array();

            $result[] = \Yii::$app->user->identity->getAuthKey();

            $user_id = \Yii::$app->user->identity->getId();

            $user = User::FindOne($user_id);
            $pi_id = $user->getPiId();

            $result[] = $pi_id;
            $result[] = $user_id;

            return $result;
        } else {
            return $model->errors;
        }


    }

    public function actionGeteducationsinfo($pi_id)
    {
        $user = new User();
        $user = User::FindOne($pi_id);
        return $user->educations;

    }

    public function actionGetlastupdatedate($user_id)
    {
        $user = new User();
        $user = User::FindOne($user_id);
        return date('d F Y', $user->updated_at);
    }

    public function actionUpdatelastdate($user_id)
    {

        $now_timestamp = time();
        // return date('d F Y',time());
        $user = new User();
        $user = User::FindOne($user_id);
        $user->updated_at = $now_timestamp;
        if ($user->update())
            return date('d F Y', $now_timestamp);
        else
            return false;

    }

    public function actionUpdateworkingstatus()
    {

        $model = new User();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

            $user = new User();
            $user = User::FindOne($inputs['id']);
            $user->working_status = $inputs['working_status'];
            if ($user->update())
                return true;
            else
                return false;
        }

    }


    public function actionGetalluser()
    {

        $user = new User();
        $user = User::findAll(['status' => User::STATUS_ACTIVE]);
        return $user;

    }

    public function actionGetpersonalinfo($pi_id)
    {
        $user = new User();
        $user = User::FindOne($pi_id);
        return $user->pi;

    }

    /*************************************************
     * Description: Get all information of an user
     * Author: Bilal
     * Modified By: Jz
     * Date: 05-10-2015
     * @param $pi_id
     * @return array
     */
    public function actionGetallinfo($pi_id)
    {
        $result = array();
        $user = new User();
        $user = User::findOne($pi_id);

        $result['user'] = $user;

        $result['educations'] =  User::findEducationDetails($pi_id);


        $result['workings'] = $user->workings;
        $result['personal'] = $user->pi;
        $result['certifications'] = $user->certifications;
        $result['skills'] = $user->skills;

//        $result['institutions'] = Institution::find()->all();
//        $result['education_levels'] = EducationLevel::find()->all();
//        $result['courses'] = Course::find()->all();
//        $result['universities'] = University::find()->all();

        return $result;

    }

    /**************************************************
     * Description: Check all available input data
     * Author: Jz
     * Date: 05/10/2015
     * @return array
     */
    public function actionPopulateeducationinputs(){
        $result = array();

        $result['institutions'] = Institution::find()->all();
        $result['education_levels'] = EducationLevel::find()->all();
        $result['courses'] = Course::findUniCourse();
        $result['universities'] = University::find()->all();

        return $result;
    }

    public function actionGetcourse($user_id)
    {

        $query = new Query;
        $jointype = "LEFT OUTER JOIN";
        $query->select('education_information.course_id, education_information.ei_graduation_year')
            ->from('user')
            ->join($jointype, 'personal_information', 'user.pi_id=personal_information.pi_id')
            ->join($jointype, 'user_education', 'user.id=user_education.id')
            ->join($jointype, 'education_information', 'user_education.ei_id=education_information.ei_id')
            ->where(['user.id' => $user_id]);


        $command = $query->createCommand();

        $data = $command->queryAll();
        return $data;

    }


    public function actionGetuserinfo($pi_id)
    {

        $result = array();
        $user = new User();
        $user = User::FindOne($pi_id);
        return $user;

    }

    public function actionGeteducationdetail($ei_id)
    {
        $result = array();
        $model = new EducationInformation();

        $model = EducationInformation::FindOne($ei_id);
        // $result['uni_id']=$model->uni_id;
        $result['course'] = $model->course;
        $result['institution'] = $model->inst;
        $result['education_level'] = $model->el;
        $result['ei_graduation_year'] = $model->ei_graduation_year;
        return $result;

    }

    public function actionListsocialmedia()
    {
        $model = new User();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

        }

        $query = new Query;
        $jointype = "LEFT OUTER JOIN";
        $query->select('user.username,user_socialmedia.*,socialmedia.*,socialmedia_platform.*')
            ->from('user')
            ->join($jointype, 'user_socialmedia', 'user.id=user_socialmedia.id')
            ->join($jointype, 'socialmedia', 'user_socialmedia.sm_id=socialmedia.sm_id')
            ->join($jointype, 'socialmedia_platform', 'socialmedia.sp_id=socialmedia_platform.sp_id');
        $query->where(['user.id' => $inputs['user_id']]);


        $command = $query->createCommand();

        $data = $command->queryAll();
        return $data;
    }

    public function actionGetallsocialmediaplatform()
    {

        $sp = new SocialmediaPlatform();
        $sp = SocialmediaPlatform::find()->all();
        return $sp;
    }

    public function actionUpdateusersocialmedia()
    {

        $sosmed = new SocialMedia();

        if ($sosmed->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $flag = true;
            $result = \Yii::$app->getRequest()->getBodyParams();

            $x = 0;
            foreach ($result as $r) {

                $sosmed = SocialMedia::findOne($r['sm_id']);
                $sosmed->sm_content = $r['sm_content'];
                $sosmed->save();

                $x++;
            }


            return $sosmed->sm_content;


        }
    }

    public function actionInsertnewsocialmedia()
    {

        $model = new SocialMedia();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

            $model->sp_id = $inputs['sp_id'];
            $model->sm_content = $inputs['sm_content'];
            if ($model->save()) {
                $sm_id = $model->sm_id;
                $usersocialmedia = new UserSocialmedia();
                $usersocialmedia->sm_id = $model->sm_id;
                $usersocialmedia->id = $inputs['user_id'];

                if ($usersocialmedia->save())
                    return $usersocialmedia->us_id;


            }


        }


    }

    public function actionDeletesocialmedia()
    {

        // delete on socialmedia table

        $model = new SocialMedia();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

            $model = User::find($inputs);
            if ($model->delete()) {
                //delete on user_socialmedia table
                //$db->createCommand()->delete('user_socialmedia', ['sm_id'=>$inputs])->execute();
                //$userSocialmedia = new UserSocialmedia::deleteAll(['sm_id'=>$inputs]);

            }

            return $userSocialmedia;

        }


    }
}

