<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property integer $uni_id
 * @property string $uni_code
 * @property string $uni_name
 * @property integer $uni_status
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uni_name', 'uni_status'], 'required'],
            [['uni_status'], 'integer'],
            [['uni_code'], 'string', 'max' => 25],
            [['uni_name'], 'string', 'max' => 220]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uni_id' => 'Uni ID',
            'uni_code' => 'University Code',
            'uni_name' => 'University Name',
            'uni_status' => 'Uni Status',
        ];
    }
}
