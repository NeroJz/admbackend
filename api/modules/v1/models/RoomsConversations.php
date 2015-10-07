<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "rooms_conversations".
 *
 * @property integer $rc_id
 * @property integer $mr_id
 * @property integer $cr_id
 *
 * @property Conversations $conversations
 * @property MessageRooms $mr
 */
class RoomsConversations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms_conversations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mr_id', 'cr_id'], 'required'],
            [['mr_id', 'cr_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rc_id' => 'Rc ID',
            'mr_id' => 'Mr ID',
            'cr_id' => 'Cr ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversations()
    {
        return $this->hasOne(Conversations::className(), ['cr_id' => 'rc_id']);
    }

    public function getAllConversations()
    {
        return $this->hasMany(Conversations::className(), ['cr_id' => 'rc_id']);
        //->viaTable('user', ['id' => 'user_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMr()
    {
        return $this->hasOne(MessageRooms::className(), ['mr_id' => 'mr_id']);
    }

   

    /**
     * @inheritdoc
     * @return RoomsConversationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomsConversationsQuery(get_called_class());
    }
}
