<?php

namespace common\widgets;

class UserProfileForm extends \yii\base\Widget
{
    public $profile;

    public function run()
    {
        if (is_null($this->profile)) {
            return 'User profile not found in system';
        }

        return $this->render('userProfileForm', [
            'model' => $this->profile,
        ]);
    }
}