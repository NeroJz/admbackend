<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "user_skills".
 *
 * @property integer $us_id
 * @property integer $user_id
 * @property integer $skill_id
 *
 * @property User $user
 * @property Skills $skill
 */
class UserSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'skill_id'], 'required'],
            [['user_id', 'skill_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'us_id' => 'Us ID',
            'user_id' => 'User ID',
            'skill_id' => 'Skill ID',
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
    public function getSkill()
    {
        return $this->hasOne(Skills::className(), ['skill_id' => 'skill_id']);
    }
}
