<?php

namespace api\modules\v1\models;


use Yii;

/**
 * This is the model class for table "user_education".
 *
 * @property integer $ue_id
 * @property integer $id
 * @property integer $ei_id
 *
 * @property User $id0
 * @property EducationInformation $ei
 */
class UserEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ei_id'], 'required'],
            [['id', 'ei_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ue_id' => 'Ue ID',
            'id' => 'ID',
            'ei_id' => 'Ei ID',
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
    public function getEi()
    {
        return $this->hasOne(EducationInformation::className(), ['ei_id' => 'ei_id']);
    }
}
