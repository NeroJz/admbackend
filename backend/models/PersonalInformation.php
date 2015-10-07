<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "personal_information".
 *
 * @property integer $pi_id
 * @property string $pi_name
 * @property string $pi_ic_or_passport
 * @property integer $pi_gender
 * @property string $pi_address
 * @property integer $pi_zipcode
 * @property string $pi_address_permanent
 * @property string $pi_zipcode_permanent
 * @property string $pi_phone_home
 * @property string $pi_hp
 * @property string $pi_email_1
 * @property string $pi_email_2
 * @property string $profile_picture
 *
 * @property User[] $users
 */
class PersonalInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pi_gender', 'pi_zipcode'], 'integer'],
            [['pi_address', 'pi_address_permanent'], 'string'],
            [['pi_name'], 'string', 'max' => 100],
            [['pi_ic_or_passport', 'pi_phone_home', 'pi_hp'], 'string', 'max' => 20],
            [['pi_zipcode_permanent'], 'string', 'max' => 10],
            [['pi_email_1'], 'string', 'max' => 36],
            [['pi_email_2'], 'string', 'max' => 38],
            [['profile_picture'], 'string', 'max' => 225]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pi_id' => 'Pi ID',
            'pi_name' => 'Pi Name',
            'pi_ic_or_passport' => 'Pi Ic Or Passport',
            'pi_gender' => 'Pi Gender',
            'pi_address' => 'Pi Address',
            'pi_zipcode' => 'Pi Zipcode',
            'pi_address_permanent' => 'Pi Address Permanent',
            'pi_zipcode_permanent' => 'Pi Zipcode Permanent',
            'pi_phone_home' => 'Pi Phone Home',
            'pi_hp' => 'Pi Hp',
            'pi_email_1' => 'Pi Email 1',
            'pi_email_2' => 'Pi Email 2',
            'profile_picture' => 'Profile Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['pi_id' => 'pi_id']);
    }

    /**
     * @inheritdoc
     * @return PersonalInformationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonalInformationQuery(get_called_class());
    }

    public function getUserPersonalInfo($id)
    {

       // $command = $query->createCommand()->queryAll();

        //$data = $command->queryAll();

       $user = User::findBySql("SELECT * FROM personal_information where pi_id=$id")
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

    public static function getUserPosition()
    {
        $currentYear = date('Y',time());
         $user = User::findBySql("SELECT COUNT(pi.pi_id) as totalstudent, r.* FROM personal_information pi join region r on pi.pi_zipcode = r.r_zipcode ".
                               // "GROUP BY r.r_id")
                                 "JOIN user u on pi.pi_id = u.pi_id ".
                                 "JOIN user_education ue on u.id = ue.id ".
                                 "JOIN education_information ei on ue.ei_id = ei.ei_id ".
                                 " WHERE ei.ei_graduation_year ='$currentYear' GROUP BY r.r_id")
                  ->asArray()
                  ->all();

          return $user;
    }

    public static function getUserPositionByYear($year)
    {
         $user = User::findBySql("SELECT COUNT(pi.pi_id) as totalstudent, r.* FROM personal_information pi ".
                               // "GROUP BY r.r_id")
                                 "JOIN user u on pi.pi_id = u.pi_id ".
                                 "JOIN user_education ue on u.id = ue.id ".
                                 "JOIN education_information ei on ue.ei_id = ei.ei_id ".
                                 "JOIN region r on pi.pi_zipcode = r.r_zipcode ".
                                 " WHERE ei.ei_graduation_year ='$year' GROUP BY r.r_zipcode")
                  ->asArray()
                  ->all();

          return $user;
    }
}
