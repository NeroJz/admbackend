<?php
 
namespace api\modules\v1\controllers;
 
use yii\rest\ActiveController;

use api\modules\v1\models\WorkingInformation;
use api\modules\v1\models\UserWorking;
use api\modules\v1\models\JobSpecialisation;
use yii\db\Query;
 

class WorkinginformationController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\WorkingInformation';

 
  public function actionInsertworkinginfo(){
      //insert to education_information table, then the id need to be inserted to user_education
       $model = new WorkingInformation();
         if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')){
         $result=\Yii::$app->getRequest()->getBodyParams();

         $model->wi_company_name=$result['wi_company_name'];
         $model->wi_position=$result['wi_position'];
         $model->wi_job_sector=$result['wi_job_sector'];
          $model->js_id=$result['js_id'];
         $model->wi_year_of_service_from=$result['wi_year_of_service_from'];
         $model->wi_year_of_service_to=$result['wi_year_of_service_to'];
         
       if($model->save()){
          $wi_id=$model->wi_id;

          $user_id=$result['user_id'];

           $userwork = new UserWorking();
           $userwork->id=$user_id;
           $userwork->wi_id=$wi_id;

            if($userwork->save())
            {
              return $model;
            }

       }
    
      }

    }
      
      public function actionGetjsname($js_id)
      {
         
         $job= new JobSpecialisation();
        $job= JobSpecialisation::FindOne($js_id);
        return $job->js_name;
      } 

      public function actionGetalljobspecialisation()
      {
         $job= new JobSpecialisation();
        $job= JobSpecialisation::findAll(['js_status'=>1]);
        return $job;
      } 

    
   
     
}
