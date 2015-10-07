<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "conversations".
 *
 * @property integer $cr_id
 * @property integer $user_id
 * @property string $message
 * @property string $timestamp
 *
 * @property User $user
 * @property RoomsConversations $cr
 */
class Conversations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['message'], 'string'],
            [['timestamp'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cr_id' => 'Cr ID',
            'user_id' => 'User ID',
            'message' => 'Message',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCr()
    {
        return $this->hasOne(RoomsConversations::className(), ['rc_id' => 'cr_id']);
    }

    /**
     * @inheritdoc
     * @return ConversationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConversationsQuery(get_called_class());
    }
}
