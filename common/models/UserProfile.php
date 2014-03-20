<?php

namespace common\models;

use kato\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "kato_user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 * @property string $full_name
 */
class UserProfile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kato_user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'full_name'], 'safe'],
            [['user_id', 'create_time', 'update_time', 'full_name'], 'required'],
            [['user_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['full_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'full_name' => 'Full Name',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * Register a new profile for user
     *
     * @param int $userId
     * @return static
     */
    public function register($userId) {

        $this->user_id = $userId;
        $this->save(false);
        return $this;
    }

    /**
     * Set user id for profile
     *
     * @param int $userId
     * @return static
     */
    public function setUser($userId) {

        $this->user_id = $userId;
        return $this;
    }

}
