<?php

namespace api\modules\v1\models;

use backend\models\EducationInformation;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use yii\web\IdentityInterface;

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
 * @property UserWorking[] $userWorkings
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['pi_id', 'username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['pi_id', 'status', 'online_status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pi_id' => 'Pi ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'online_status' => 'Online Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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


    public function getEducations()
    {
        return $this->hasMany(EducationInformation::className(), ['ei_id' => 'ei_id'])
            ->viaTable('user_education', ['id' => 'id']);
    }

    public function findEducationDetails($user_id)
    {
        $query = (new \yii\db\Query());
        return $query->select(['course_name', 'course.course_id', 'course.course_code', 'ei_graduation_year', 'ue_id', 'el_code', 'inst_name', 'uni_name', 'university.uni_id'])
            ->from('education_information')
            ->innerJoin('course', 'course.course_id = education_information.course_id')
            ->innerJoin('user_education', 'user_education.ei_id = education_information.ei_id')
            ->innerJoin('education_level', 'education_level.el_id = education_information.el_id')
            ->innerJoin('institution', 'institution.inst_id = education_information.inst_id')
            ->innerJoin('university', 'university.uni_id = institution.uni_id')
            ->where(['user_education.id' => $user_id])
            ->all();
    }

    public function findAllUsersInfo($fields, $filter = null, $order_by = null)
    {
        $query = (new \yii\db\Query());
        $query->select($fields)
            ->from('user')
            ->innerJoin('personal_information', 'personal_information.pi_id = user.pi_id')
            ->innerJoin('user_education', 'user_education.id = user.pi_id')
            ->innerJoin('education_information', 'education_information.ei_id = user_education.ei_id')
            ->innerJoin('course', 'course.course_id = education_information.course_id')
            ->innerJoin('institution_course', 'institution_course.course_id = course.course_id')
            ->innerJoin('institution', 'institution.inst_id = institution_course.inst_id');


        if ($filter != null) {
            $fields = array();
            foreach ($filter as $key => $value) {
                $fields[$key] = $value;
            }

            $query->where($fields);
        }

        if ($order_by != null) {
            $query->orderBy($order_by);
        }

        return $query->all();
    }

    public function getWorkings()
    {
        return $this->hasMany(WorkingInformation::className(), ['wi_id' => 'wi_id'])
            ->viaTable('user_working', ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWorkings()
    {
        return $this->hasMany(UserWorking::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCertification()
    {
        return $this->hasMany(UserCertification::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertifications()
    {
        return $this->hasMany(Certification::className(), ['cert_id' => 'cert_id'])
            ->viaTable('user_certification', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSkills()
    {
        return $this->hasMany(UserSkills::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::className(), ['skill_id' => 'skill_id'])
            ->viaTable('user_skills', ['user_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getPiId()
    {
        return $this->pi_id;
    }

}
