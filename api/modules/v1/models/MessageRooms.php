<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "message_rooms".
 *
 * @property integer $mr_id
 * @property integer $user_id_1
 * @property integer $user_id_2
 *
 * @property User $userId2
 * @property User $userId1
 * @property RoomsConversations[] $roomsConversations
 */
class MessageRooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id_1', 'user_id_2'], 'required'],
            [['user_id_1', 'user_id_2'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mr_id' => 'Mr ID',
            'user_id_1' => 'User Id 1',
            'user_id_2' => 'User Id 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserId2()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserId1()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsConversations()
    {
        return $this->hasMany(RoomsConversations::className(), ['mr_id' => 'mr_id']);
    }

     public function getAllconversations()
    {
        return $this->hasMany(Conversations::className(), ['cr_id' => 'mr_id'])
            ->viaTable('rooms_conversations', ['rc_id' => 'mr_id']);
    }

    /**
     * @inheritdoc
     * @return MessageRoomsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageRoomsQuery(get_called_class());
    }
}
