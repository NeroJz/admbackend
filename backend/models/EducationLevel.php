<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "education_level".
 *
 * @property integer $el_id
 * @property string $el_code
 * @property string $el_name
 *
 * @property EducationInformation[] $educationInformations
 */
class EducationLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'education_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['el_code', 'el_name'], 'required'],
            [['el_code'], 'string', 'max' => 10],
            [['el_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'el_id' => 'El ID',
            'el_code' => 'Education level Code',
            'el_name' => 'Education level Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducationInformations()
    {
        return $this->hasMany(EducationInformation::className(), ['el_id' => 'el_id']);
    }

    /**
     * @inheritdoc
     * @return EducationLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EducationLevelQuery(get_called_class());
    }

}
