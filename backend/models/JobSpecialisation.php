<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_specialisation".
 *
 * @property integer $js_id
 * @property string $js_name
 * @property integer $js_status
 */
class JobSpecialisation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_specialisation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['js_name', 'js_status'], 'required'],
            [['js_status'], 'integer'],
            [['js_name'], 'string', 'max' => 220]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'js_id' => 'Js ID',
            'js_name' => 'Js Name',
            'js_status' => 'Js Status',
        ];
    }
}
