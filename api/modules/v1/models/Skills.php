<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property integer $skill_id
 * @property string $skill_name
 *
 * @property UserSkills[] $userSkills
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_name'], 'required'],
            [['skill_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skill_id' => 'Skill ID',
            'skill_name' => 'Skill Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSkills()
    {
        return $this->hasMany(UserSkills::className(), ['skill_id' => 'skill_id']);
    }
}
