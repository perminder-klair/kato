<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use common\models\UserProfile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
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
            if ($user = User::create($this->attributes)) {
                //Create user profile
                $profile = new UserProfile();
                $profile->register($user->id);

                if ($user->id == 1) {
                    $user->role = 'admin';
                } else {
                    $user->role = 'user';
                }
                $user->save();
            }

            return $user;
        }
        return null;
    }
}