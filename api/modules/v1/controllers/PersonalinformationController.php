<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\User;
use yii\rest\ActiveController;
use api\modules\v1\models\PersonalInformation;
use api\modules\v1\models\Certification;
use api\modules\v1\models\UserCertification;
use api\modules\v1\models\Skills;
use api\modules\v1\models\UserSkills;
use yii\db\Query;


class PersonalinformationController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\PersonalInformation';

    public function actionGetall()
    {

        $students = new PersonalInformation();
        $students = PersonalInformation::find()->all();
        return $students;
    }

    public function actionGetuserbyname($pi_name = "")
    {

        $students = new PersonalInformation();
        $students = PersonalInformation::find()->where(['like', 'pi_name', '%' . $pi_name . '%', false])->one();
        return $students;
    }

    public function actionSearchuser()
    {
        $model = new PersonalInformation();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

        }

        $pi_name = "";
        $query = new Query;
        $jointype = "LEFT OUTER JOIN";
        $query->select('personal_information.pi_id,personal_information.pi_name,institution.inst_code,course.course_name')
            ->from('user')
            ->join($jointype, 'personal_information', 'user.pi_id=personal_information.pi_id')
            ->join($jointype, 'user_education', 'user.id=user_education.id')
            ->join($jointype, 'education_information', 'user_education.ei_id=education_information.ei_id')
            ->join($jointype, 'course', 'course.course_id=education_information.course_id')
            ->join($jointype, 'institution', 'education_information.inst_id=institution.inst_id');

        /*
         if(!empty($inputs['pi_name']))
      {
              if($inputs['pi_name']=="")
               unset($inputs['pi_name']);
           }
  */


        if (!empty($inputs)) {

            if (!empty($inputs['pi_name'])) {
                $pi_name = $inputs['pi_name'];
                //unset($inputs['pi_name']);
            }

            $query->where($inputs);

            if (!empty($pi_name) OR $pi_name !== "") {
                $query->where(['like', 'pi_name', '%' . $pi_name . '%', false]);
            }

            if (!empty($inputs['inst_code']))
                $query->andWhere(['inst_code' => $inputs['inst_code']]);

            if (!empty($inputs['course_code']))
                $query->andWhere(['course_code' => $inputs['course_code']]);

            if (!empty($inputs['ei_graduation_year']))
                $query->andWhere(['ei_graduation_year' => $inputs['ei_graduation_year']]);


        }
        /*
          $x=sizeof($inputs);
        foreach($inputs as $key=>$value)
                {
                  if($x==0)
                  {
                    if($key=='pi_name')
                    $query->where(['like',$key,'%'.$value.'%',false]);
                    else
                    $query->where([$key=>$value]);
                  }
                 else
                 {
                  if($key=='pi_name')
                  $query->where(['like',$key,'%'.$value.'%',false]);
                  else
                    $query->where([$key=>$value]);

                 }

               }
               */

        $command = $query->createCommand();

        $data = $command->queryAll();
        return $data;

        /* 
        $personalinfo = new PersonalInformation();
        $user= new User();
        $education = new Education();
        
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $result=\Yii::$app->getRequest()->getBodyParams();
         return $result;
        }
        */

    }

    public function actionSearchallusers()
    {
        $model = new User();
        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();

            $fields = array(
                'pi_name',
                'user.pi_id',
                'course_name',
                'course_code',
                'inst_name',
                'inst_code',
                'ei_graduation_year',
                'pi_email_1',
                'pi_title',
                'pi_company'
            );

            $order = array(
                'inst_name' => 'asc',
                'course_name' => 'asc',
                'ei_graduation_year' => 'asc',
                'pi_name' => 'asc'
            );

            $uni_id = (empty($inputs['uni_id'])) ? null : $inputs['uni_id'];
            $courses_id = (empty($inputs['courses'])) ? null : $inputs['courses'];
            $ei_graduation_year = (empty($inputs['years'])) ? null : $inputs['years'];

            $filter = array();


            if ($uni_id != null) {
                $filter['uni_id'] = $uni_id;
            }

            if ($courses_id != null) {
                $filter['course.course_id'] = $courses_id;
            }

            if ($ei_graduation_year != null) {
                $filter['ei_graduation_year'] = $ei_graduation_year;
            }


            $user = User::findAllUsersInfo($fields, $filter, $order);

            return $user;
        }
    }

    public function actionGetbasedonindexchat($from)
    { //from starting from 0

        $students = new PersonalInformation();

        $query = "SELECT pi_id,pi_name,pi_hp FROM personal_information LIMIT $from,1";


        $students = PersonalInformation::findBySql($query)->all();
        return $students;


    }

    public function actionGetbasedonindex($from)
    { //from starting from 0

        $model = new PersonalInformation();


        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {

            $result = \Yii::$app->getRequest()->getBodyParams();
            $a = array();
            $b = array();

            foreach ($result as $key => $value) {
                $a[] = $value['course_id'];
                $b[] = $value['ei_graduation_year'];
            }

            $s = sizeof($a);

            $k = ""; //course_id

            $x = 0;
            foreach ($a as $aa) {

                if ($s - 1 == $x) {
                    $k .= '(' . $a[$x] . ',' . $b[$x] . ')';

                } else {
                    $k .= '(' . $a[$x] . ',' . $b[$x] . ')' . ',';

                }

                $x++;
            }


            $students = new PersonalInformation();

            //$query="SELECT pi_id,pi_name,pi_hp FROM personal_information LIMIT $from,1";
            $query = "SELECT personal_information.pi_id, personal_information.pi_name, personal_information.pi_hp FROM user INNER JOIN personal_information ON user.pi_id = personal_information.pi_id" .
                " INNER JOIN user_education ON user.id=user_education.id " .
                "INNER JOIN education_information ON user_education.ei_id=education_information.ei_id" .
                " WHERE (education_information.course_id,education_information.ei_graduation_year) IN ($k)" .
                " LIMIT $from,1";

            /*

            SELECT personal_information.pi_id, personal_information.pi_name, personal_information.pi_hp
            FROM user INNER JOIN personal_information ON user.pi_id = personal_information.pi_id
            INNER JOIN user_education ON user.id=user_education.id
            INNER JOIN education_information ON user_education.ei_id=education_information.ei_id
            WHERE (education_information.course_id,education_information.ei_graduation_year) IN ((7,2008)) LIMIT 3,1
            */

            $students = PersonalInformation::findBySql($query)->all();
            return $students;
        }

    }

    public function actionGetnumberofrows()
    {
        $students = new PersonalInformation();

        $students = PersonalInformation::find()->count();
        return $students;
    }

    public function actionGetnumberofrowsbrowse()
    {
        $model = new PersonalInformation();


        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {

            $result = \Yii::$app->getRequest()->getBodyParams();
            $a = array();
            $b = array();

            foreach ($result as $key => $value) {
                $a[] = $value['course_id'];
                $b[] = $value['ei_graduation_year'];
            }

            $s = sizeof($a);

            $k = ""; //course_id

            $x = 0;
            foreach ($a as $aa) {

                if ($s - 1 == $x) {
                    $k .= '(' . $a[$x] . ',' . $b[$x] . ')';

                } else {
                    $k .= '(' . $a[$x] . ',' . $b[$x] . ')' . ',';

                }

                $x++;
            }


            $students = new PersonalInformation();

            //$query="SELECT pi_id,pi_name,pi_hp FROM personal_information LIMIT $from,1";
            $query = "SELECT personal_information.pi_id, personal_information.pi_name, personal_information.pi_hp FROM user INNER JOIN personal_information ON user.pi_id = personal_information.pi_id" .
                " INNER JOIN user_education ON user.id=user_education.id " .
                "INNER JOIN education_information ON user_education.ei_id=education_information.ei_id" .
                " WHERE (education_information.course_id,education_information.ei_graduation_year) IN ($k)";
            $students = PersonalInformation::findBySql($query)->all();
            return $students;
        }
    }

    public function actionUpdatepersonalinfo($pi_id)
    {
        $model = new PersonalInformation();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $result = \Yii::$app->getRequest()->getBodyParams();

            $personal = PersonalInformation::findOne($pi_id);

            if (PersonalInformation::updateAll($result, ['pi_id' => $pi_id]))
                return true;
            else
                return false;


        }
    }

    /*
     * Description: Update User Certifications
     * Author: Jz
     * Date: 21/09/2015
     * Return {certification model}
     */
    public function actionUpdatecertificationinfo()
    {

        $certification = new Certification();

        if ($certification->load(\Yii::$app->getRequest()->getBodyParams(), '')) {

            $result = \Yii::$app->getRequest()->getBodyParams();

            $certification->cert_name = $result['cert_name'];
            $certification->cert_serial_no = (empty($result['cert_serial_no'])) ? null : $result['cert_serial_no'];
            $certification->cert_year_from = $result['cert_year_from'];
            $certification->cert_year_to = $result['cert_year_to'];

            if ($certification->save()) {
                $cert_id = $certification->cert_id;
                $user_id = $result['user_id'];

                $userCertification = new UserCertification();
                $userCertification->user_id = $user_id;
                $userCertification->cert_id = $cert_id;

                if ($userCertification->save()) {
                    return $certification;
                } else {
                    return $certification;
                }
            }
        }
    }

    /*********************************************
     * Description: Delete certification
     * Author: Jz
     * Date: 22/09/2015
     * @return model
     */
    public function actionDeletecertification()
    {
        $cert_id = \Yii::$app->request->post('cert_id');

        $model = Certification::findOne($cert_id);

        if ($model->delete()) {
            return $model;
        } else {
            return $model;
        }

    }

    /*********************************************
     * Description : Update skill of user
     * Author: Jz
     * Date: 22/09/2015
     * @return UserSkills
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdateskill()
    {
        $skills = new Skills();

        if ($skills->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $result = \Yii::$app->getRequest()->getBodyParams();

            $skills->skill_name = $result['skill_name'];

            if ($skills->save()) {
                $skill_id = $skills->skill_id;
                $user_id = $result['user_id'];

                $userSkill = new UserSkills();

                $userSkill->skill_id = $skill_id;
                $userSkill->user_id = $user_id;

                if ($userSkill->save()) {
                    return $userSkill;
                } else {
                    return $userSkill;
                }
            }
        }
    }

    /*********************************************
     * Description: Delete skill based on skill_id
     * Author: Jz
     * Date: 22/090/2015
     * @return skills model
     */
    public function actionDeleteskill()
    {
        $skill_id = \Yii::$app->request->post('skill_id');

        $model = Skills::findOne($skill_id);

        if ($model->delete()) {
            return $model;
        } else {
            return $model;
        }
    }


}
