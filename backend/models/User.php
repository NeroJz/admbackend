<?php

namespace backend\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $pi_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $online_status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PersonalInformation $pi
 * @property UserEducation[] $userEducations
 * @property UserSocialmedia[] $userSocialmedia
 * @property UserWorking[] $userWorkings
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'user';

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pi_id', 'username','created_at', 'updated_at'], 'required'],
            [['pi_id', 'online_status', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'string'],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            //[['created_at'],'date', 'format' => 'yyyy-M-d H:m:s'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pi_id' => 'Full Name',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Email',
            'online_status' => 'Primary Email',
            'created_at' => 'Handphone',
            'updated_at' => 'Phone (home)',
            'pi_name' => 'full Name',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPi()
    {
        return $this->hasOne(PersonalInformation::className(), ['pi_id' => 'pi_id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEducations()
    {
        return $this->hasMany(UserEducation::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * join table jauuuh
     */
    public function getEducationInformation()
    {
        return $this->hasOne(EducationInformation::className(), ['ei_id' => 'ei_id'])
                    ->via('userEducations');
    }

    /**
     * @return \yii\db\ActiveQuery
     * join table jauuuh
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['course_id' => 'course_id'])
                    ->via('educationInformation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocialmedia()
    {
        return $this->hasMany(UserSocialmedia::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkings()
    {
        return $this->hasMany(UserWorking::className(), ['id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function getAllUsers($id)
    {
       $user = User::findBySql('SELECT u.*, pi.* FROM user u join personal_information pi on u.pi_id = pi.pi_id where u.id='.$id.'')
                ->asArray()
                ->all();

        return $user;
    }

    public function getUserInfo($id)
    {

       // $command = $query->createCommand()->queryAll();

        //$data = $command->queryAll();

       $user = User::findBySql("SELECT * FROM user where pi_id=$id")
                ->asArray()
                ->one();

      /*  $model = User::find()
                    ->select('*')
                    ->leftJoin('personal_information', '`user`.`pi_id` = `personal_information`.`pi_id`')
                    //->where(['order.status' => Order::STATUS_ACTIVE])
                    //->with('orders')
                    ->all();*/

        return $user;
    }

    public function updateStatus($id)
    {
        Yii::$app->db->createCommand("UPDATE user SET status=20 WHERE id=$id")
       // ->bindValue(':id', your_id)
        ->execute();
    }

    public static function getUserEducation($id)
    {

       $user = User::findBySql('SELECT ei.el_id,ei.inst_id, ei.course_id, ue.id,i.inst_name,uni.uni_code,uni.uni_name,c.course_name, el.el_name,ei.ei_graduation_year FROM user_education ue '.
                                'join education_information ei on ue.ei_id = ei.ei_id '.
                                'join course c on ei.course_id = c.course_id '.                         
                                'join education_level el on ei.el_id = el.el_id '.
                                'join institution i on ei.inst_id = i.inst_id '.
                                'join university uni on i.uni_id= uni.uni_id where ue.id='.$id.'')
                ->asArray()
                ->all();

        return $user;
    }

    public static function getUserWorking($id)
    {
        $user = User::findBySql('SELECT wi.* FROM user_working uw '.
                                 'join working_information wi on uw.wi_id = wi.wi_id where uw.id='.$id.'')
                 ->asArray()
                 ->all();

         return $user;
    }

    public static function UpdateRecordEducation($id,$updateFactID,$updateCourse,$updateLevel,$updateYear)
    {
        $user = User::findBySql("UPDATE user_education ue ".
                                "JOIN education_information ei on ei.ei_id = ue.ei_id ".
                                "SET ei.inst_id ='".$updateFactID."', ei.course_id ='".$updateCourse."', ".
                                "ei.el_id = '".$updateLevel."', ei.ei_graduation_year ='".$updateYear."' ".
                                "WHERE ue.id =".$id."")
                 ->asArray()
                 ->all();

         return $user;
    }

    public static function saveneweducationrecord()
    {
        print_r($_POST);
        die();
    }
}
