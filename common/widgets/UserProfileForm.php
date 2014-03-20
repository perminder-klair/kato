<?php

namespace common\widgets;

use common\models\UserProfile;

class UserProfileForm extends \yii\base\Widget
{
    public $model;

    public $userId;

    public function init()
    {
        parent::init();

        $this->model = UserProfile::find()
            ->where(['user_id' => $this->userId])
            ->one();
    }

    public function run()
    {
        if (is_null($this->model)) {
            return 'User profile not found in system';
        }

        echo $this->render('userProfileForm', [
            'model' => $this->model,
        ]);
    }
}