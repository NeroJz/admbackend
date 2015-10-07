<?php

namespace api\modules\v1\models;


use Yii;

/**
 * This is the model class for table "user_socialmedia".
 *
 * @property integer $us_id
 * @property integer $id
 * @property integer $sm_id
 *
 * @property User $id0
 * @property Socialmedia $sm
 */
class UserSocialmedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_socialmedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sm_id'], 'required'],
            [['id', 'sm_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'us_id' => 'Us ID',
            'id' => 'user_id',
            'sm_id' => 'socialmedia_id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSm()
    {
        return $this->hasOne(Socialmedia::className(), ['sm_id' => 'sm_id']);
    }

    /**
     * @inheritdoc
     * @return UserSocialmediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSocialmediaQuery(get_called_class());
    }
}
