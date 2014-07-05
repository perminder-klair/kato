<?php

namespace common\models;

use Yii;
use kato\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\helpers\Inflector;
use ReflectionClass;

/**
 * Class User
 * @package common\models
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $role
 * @property string $auth_key
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property string $password write-only password
 * @property string $login_ip
 * @property string $login_time
 */
class User extends ActiveRecord implements IdentityInterface
{
	/**
	 * @var string the raw password. Used to collect password input and isn't saved in database
	 */
	public $password;

	const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    const ROLE_ADMIN = 'admin';
	const ROLE_USER = 'user';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kato_user';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'defaultTitle' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'username',
                'defaultPrefix' => 'user',
            ],
            'defaultEmail' => [
                'class' => 'kato\behaviors\DefaultTitle',
                'attribute' => 'email',
                'defaultPrefix' => 'user@email.com',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['password'], 'safe'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_NOT_ACTIVE]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getProfile() {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
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
	 * @return null|User
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username, 'status' => static::STATUS_ACTIVE]);
	}

	/**
	 * @return int|string current user ID
	 */
	public function getId()
	{
        return $this->getPrimaryKey();
	}

	/**
	 * @return string current user auth key
	 */
	public function getAuthKey()
	{
        return $this->getAuthKey() === $this->authKey;
	}

	/**
	 * @param string $authKey
	 * @return boolean if auth key is valid for current user
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Security::validatePassword($password, $this->password_hash);
	}

	/*public function scenarios()
	{
		return [
			'signup' => ['username', 'email', 'password'],
			'resetPassword' => ['password'],
			'requestPasswordResetToken' => ['email'],
		];
	}*/

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (($this->isNewRecord || $this->getScenario() === 'resetPassword') || (!empty($this->password) || !is_null($this->password))) {
				$this->password_hash = Security::generatePasswordHash($this->password);
			}
			if ($this->isNewRecord) {
				$this->auth_key = Security::generateRandomKey();
			} else {
                //Update user role in auth
                if (!is_null($this->role)) {
                    $this->updateRole($this->role);
                }
            }


			return true;
		}
		return false;
	}

    /**
     * This method is called at the end of inserting or updating a record.
     */
    public function afterSave($insert = true)
    {
        if (parent::afterSave($insert, [])) {
            $this->updateRole($this->role);
            $this->save();
        }
    }


    /**
     * Creates a new user
     *
     * @param array $attributes the attributes given by field => value
     * @return static|null the newly created model, or null on failure
     */
    public static function create($attributes)
    {
        /** @var User $user */
        $user = new static();
        $user->setAttributes($attributes);
        $user->setPassword($attributes['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int)end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Get a clean display name for the user
     *
     * @var string $default
     * @return string|int
     */
    public function getDisplayName($default = "") {

        // define possible names
        $possibleNames = [
            "username",
            "email",
        ];

        // go through each and return if valid
        foreach ($possibleNames as $possibleName) {
            if (!empty($this->$possibleName)) {
                return $this->$possibleName;
            }
        }

        return $default;
    }

    /**
     * Set login ip and time
     * TODO complete this
     * @param bool $save Save record
     * @return static
     */
    public function setLoginIpAndTime($save = true) {

        // set data
        $this->login_ip = Yii::$app->getRequest()->getUserIP();
        $this->login_time = date("Y-m-d H:i:s");

        // save and return
        // auth key is added here in case user doesn't have one set from registration
        // it will be calculated in [[before_save]]
        if ($save) {
            $this->save(false, ["login_ip", "login_time", "auth_key"]);
        }
        return $this;
    }

    /**
     * Returns list of available roles
     * @return array
     */
    public function listRoles()
    {
        static $data;
        if ($data === null) {

            // create a reflection class to get constants
            $refl = new ReflectionClass(get_called_class());
            $constants = $refl->getConstants();

            // check for status constants (e.g., STATUS_ACTIVE)
            foreach ($constants as $constantName => $constantValue) {

                // add prettified name to dropdown
                if (strpos($constantName, "ROLE_") === 0) {
                    $prettyName = str_replace("ROLE_", "", $constantName);
                    $prettyName = Inflector::humanize(strtolower($prettyName));
                    $data[$constantValue] = $prettyName;
                }
            }
        }

        return $data;
    }

    /**
     * Creates new Role
     * Usage: $this->createRole('admin');
     *
     * @param $key
     * @return bool
     */
    public static function createRole($key)
    {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($key);
        if ($auth->add($role)) {
            return true;
        }
        return false;
    }

    /**
     * Removed all previous rules and Updates user's rule
     * @param $roleName
     * @return bool
     */
    private function updateRole($roleName)
    {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($roleName);
        $auth->revokeAll($this->id);
        if ($auth->assign($role, $this->id)) {
            return true;
        }
        return false;
    }

    /**
     * Check if user can do specified $permission
     * TODO complete it
     * @param string $permission
     * @return bool
     */
    public function can($permission) {
        return $this->role->checkPermission($permission);
    }
}
