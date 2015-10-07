<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "certification".
 *
 * @property integer $cert_id
 * @property string $cert_name
 * @property string $cert_serial_no
 * @property string $cert_year_from
 * @property string $cert_year_to
 *
 * @property UserCertification[] $userCertifications
 */
class Certification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cert_name', 'cert_year_from', 'cert_year_to'], 'required'],
            [['cert_name', 'cert_serial_no'], 'string'],
            [['cert_year_from', 'cert_year_to'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cert_id' => 'Cert ID',
            'cert_name' => 'Cert Name',
            'cert_serial_no' => 'Cert Serial No',
            'cert_year_from' => 'Cert Year From',
            'cert_year_to' => 'Cert Year To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCertifications()
    {
        return $this->hasMany(UserCertification::className(), ['cert_id' => 'cert_id']);
    }
}
