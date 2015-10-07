<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "socialmedia".
 *
 * @property integer $sm_id
 * @property integer $sp_id
 * @property string $sm_content
 *
 * @property SocialmediaPlatform $sp
 * @property UserSocialmedia[] $userSocialmedia
 */
class SocialMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socialmedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sp_id'], 'required'],
            [['sp_id'], 'integer'],
            [['sm_content'], 'string', 'max' => 225]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sm_id' => 'Sm ID',
            'sp_id' => 'social media platform',
            'sm_content' => 'Sm Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSp()
    {
        return $this->hasOne(SocialmediaPlatform::className(), ['sp_id' => 'sp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocialmedia()
    {
        return $this->hasMany(UserSocialmedia::className(), ['sm_id' => 'sm_id']);
    }

    /**
     * @inheritdoc
     * @return SocialMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SocialMediaQuery(get_called_class());
    }
}
