<?php

namespace backend\controllers;

class MessageRoomsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
