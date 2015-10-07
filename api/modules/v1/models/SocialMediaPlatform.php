<?php

namespace api\modules\v1\models;

use Yii;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;
/**
 * This is the model class for table "socialmedia_platform".
 *
 * @property integer $sp_id
 * @property string $sp_logo
 * @property string $sp_name
 * @property string $sp_description
 *
 * @property Socialmedia[] $socialmedia
 */
class SocialmediaPlatform extends \yii\db\ActiveRecord
{
    public $imageFile; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socialmedia_platform';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['sp_logo', 'sp_name', 'sp_description'], 'required'],
        //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 1, 'mimeTypes'=>'image/png'],
        [['sp_description'], 'string'],
        [['sp_logo'], 'string', 'max' => 200],
        [['sp_name'], 'string', 'max' => 100]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        //'sp_id' => 'Sp ID',
        'sp_logo' => 'Logo',
        'sp_name' => 'Name',
        'sp_description' => 'Description',
       
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialmedia()
    {
        return $this->hasMany(Socialmedia::className(), ['sp_id' => 'sp_id']);
    }

    /**
     * @inheritdoc
     * @return SocialmediaPlatformQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SocialMediaPlatformQuery(get_called_class());
    }
}