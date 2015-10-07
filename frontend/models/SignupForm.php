<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use backend\models\AuthAssignment;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $firstname;
    public $lastname;
    public $notelp;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['firstname','required'],
            ['lastname','required'],
            ['notelp','required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->notelp = $this->notelp;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
               

                //add to auth_assignment table
                $permission=new AuthAssignment;
                $permission->user_id=$user->id;
                $permission->item_name='user';
                $permission->save();

                 return $user;
            }
        }

        return null;
    }
}
