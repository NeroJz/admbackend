<?php
 
namespace api\modules\v1\controllers;
 
use yii\rest\ActiveController;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\EducationInformation;
use api\modules\v1\models\User;
use api\modules\v1\models\SocialmediaPlatform;
use api\modules\v1\models\SocialMedia;
use api\modules\v1\models\UserSocialmedia;
use api\modules\v1\models\UserSocialmediaQuery;
use yii\db\Query;
use yii\app\gcm;



class PushnotificationController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';


    public function actionSendpush(){

        $model = new User();
        
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
           $inputs=\Yii::$app->getRequest()->getBodyParams();

           $push_tokens=$inputs['push_tokens'];
           $message=$inputs['message'];

           /* @var $apnsGcm \bryglen\apnsgcm\Gcm */
           $gcm = Yii::$app->gcm;
           $gcm->send($push_tokens, $message,
            [
            'customerProperty' => 1,
            ],
            [
            'timeToLive' => 3
            ],
            );

         
        }
     
    }
}

