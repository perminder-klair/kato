<?php

namespace common\widgets;

use common\models\UserProfile;

class UserProfileForm extends \yii\base\Widget
{
    public $profile;

    public function run()
    {
        if (is_null($this->profile)) {
            return 'User profile not found in system';
        }

        echo $this->render('userProfileForm', [
            'model' => $this->profile,
        ]);
    }
}