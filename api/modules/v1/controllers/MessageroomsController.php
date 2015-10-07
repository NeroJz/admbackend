<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

use api\modules\v1\models\MessageRooms;
use api\modules\v1\models\RoomsConversations;
use api\modules\v1\models\Conversations;
use api\modules\v1\models\User;
use yii\db\Query;


class MessageroomsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\MessageRooms';


    public function actionGetallmessagerooms()
    {
        $model = new MessageRooms();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $user_id_1 = \Yii::$app->getRequest()->getBodyParams();

            $result = array();

            $messages = MessageRooms::find()->where(['OR', "user_id_1=$user_id_1", "user_id_2=$user_id_1"])->all();

            return $messages;
        } else {
            return null;
        }

    }


    public function actionGetmessageroom()
    {
        $model = new MessageRooms();

        $inputs = array();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $inputs = \Yii::$app->getRequest()->getBodyParams();
            $user_id_1 = $inputs['user_id_1'];
            $user_id_2 = $inputs['user_id_2'];

            $message_rooms = MessageRooms::find()->where(['user_id_1' => $user_id_1, 'user_id_2' => $user_id_2])->one();

            if($message_rooms){
                $result['conversations'] = $message_rooms->allconversations;
            }

            $result['message_rooms'] = $message_rooms;

            return $result;
        }

    }

    public function actionGetlatestmessage($mr_id)
    {
        $model = new RoomsConversations();
        $model = RoomsConversations::find()->where(['mr_id' => $mr_id])->OrderBy(['rc_id' => SORT_DESC])->one();
        return $model->conversations;

    }

    public function actionGetmessages($mr_id)
    {
        $model = new RoomsConversations();
        /*$model=new RoomsConversations();
        $model = RoomsConversations::find()->where(['mr_id'=>$mr_id])->all();
        return $model;
          */
        $query = new Query;
        $jointype = "LEFT OUTER JOIN";
        $query->select('personal_information.pi_id,personal_information.pi_name,
        user.id,message_rooms.mr_id,conversations.cr_id,conversations.message,conversations.timestamp,message_rooms.user_id_2')
            ->from('rooms_conversations')
            ->join($jointype, 'message_rooms', 'message_rooms.mr_id=rooms_conversations.mr_id')
            ->join($jointype, 'conversations', 'rooms_conversations.cr_id=conversations.cr_id')
            ->join($jointype, 'user', 'user.id=conversations.user_id')
            ->join($jointype, 'personal_information', 'user.pi_id=personal_information.pi_id')
            ->where(['rooms_conversations.mr_id' => $mr_id]);
        $command = $query->createCommand();

        $data = $command->queryAll();
        return $data;
    }

    public function actionInsertmessageroom()
    {

        $model = new MessageRooms();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {
            $chatData = \Yii::$app->getRequest()->getBodyParams();


            $model->user_id_1 = $chatData['user_id_1'];
            $model->user_id_2 = $chatData['user_id_2'];
            if ($model->save()) {
                return $model->mr_id;
            }

        }

    }

    public function actionMessageinsert()
    {
        $messageRooms = new MessageRooms();

        $input = \Yii::$app->getRequest()->getBodyParams();


        $user_id_1 = (empty($input['sender_id'])) ? null : $input['sender_id'];
        $user_id_2 = (empty($input['received_id'])) ? null : $input['received_id'];
        $message = (empty($input['message'])) ? null : $input['message'];
        $mr_id = (empty($input['mr_id'])) ? null : $input['mr_id'];

        if (is_null($mr_id)) {
            $messageRooms->user_id_1 = $user_id_1;
            $messageRooms->user_id_2 = $user_id_2;
            $messageRooms->save();
        } else {
            $messageRooms = MessageRooms::find($mr_id);
        }

        $conversation = new Conversations();
        $conversation->user_id = $user_id_1;
        $conversation->message = $message;


        if ($conversation->save()) {
            $cr_id = $conversation->cr_id;
            $roomConversation = new RoomsConversations();
            $roomConversation->cr_id = $cr_id;
            $roomConversation->mr_id = $messageRooms->mr_id;

            if ($roomConversation->save()) {
                return $conversation;
            } else {
                return false;
            }
        }
    }

    public function actionSendmessage()
    {

        //insert into conversation first and get the PK
        //then insert into rooms_conversations by adding the conversation's PK
        $model = new Conversations();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '')) {

            $chatData = \Yii::$app->getRequest()->getBodyParams();


            $model->user_id = $chatData['user_id'];
            $model->message = $chatData['message'];

            if ($model->save()) {
                $cr_id = $model->cr_id;
                $room = new RoomsConversations();
                $room->mr_id = $chatData['mr_id'];
                $room->cr_id = $cr_id;
                return $room->save();
            }

        }

    }

}
