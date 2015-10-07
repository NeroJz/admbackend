<?php

namespace backend\controllers;

class ConversationsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
