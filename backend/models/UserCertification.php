<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_certification".
 *
 * @property integer $uc_id
 * @property integer $user_id
 * @property integer $cert_id
 *
 * @property User $user
 * @property Certification $cert
 */
class UserCertification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_certification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cert_id'], 'required'],
            [['user_id', 'cert_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uc_id' => 'Uc ID',
            'user_id' => 'User ID',
            'cert_id' => 'Cert ID',
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
    public function getCert()
    {
        return $this->hasOne(Certification::className(), ['cert_id' => 'cert_id']);
    }
}
