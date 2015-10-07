<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_working".
 *
 * @property integer $uw_id
 * @property integer $id
 * @property integer $wi_id
 *
 * @property User $id0
 * @property WorkingInformation $wi
 */
class UserWorking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_working';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wi_id'], 'required'],
            [['id', 'wi_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uw_id' => 'Uw ID',
            'id' => 'user_id',
            'wi_id' => 'Wi ID',
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
    public function getWi()
    {
        return $this->hasOne(WorkingInformation::className(), ['wi_id' => 'wi_id']);
    }

    /**
     * @inheritdoc
     * @return UserWorkingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserWorkingQuery(get_called_class());
    }
}
