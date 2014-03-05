<?php

namespace common\kato\helpers;

use backend\models\Setting;

class KatoHtml extends \yii\base\Object
{
    public static function setting($key)
    {
        $model = Setting::find()
            ->where(['define' => $key])
            ->one();

        if ($model) {
            return $model->value;
        }

        return false;
    }
}