<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "working_information".
 *
 * @property integer $wi_id
 * @property string $wi_company_name
 * @property string $wi_position
 * @property string $wi_year_of_service_from
 * @property string $wi_year_of_service_to
 *
 * @property UserWorking[] $userWorkings
 */
class WorkingInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'working_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wi_company_name', 'wi_position', 'wi_year_of_service_from', 'wi_year_of_service_to'], 'required'],
            [['wi_company_name', 'wi_position'], 'string', 'max' => 200],
            [['wi_year_of_service_from', 'wi_year_of_service_to'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wi_id' => 'Wi ID',
            'wi_company_name' => 'Wi Company Name',
            'wi_position' => 'Wi Position',
            'wi_year_of_service_from' => 'Wi Year Of Service From',
            'wi_year_of_service_to' => 'Wi Year Of Service To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkings()
    {
        return $this->hasMany(UserWorking::className(), ['wi_id' => 'wi_id']);
    }
}
