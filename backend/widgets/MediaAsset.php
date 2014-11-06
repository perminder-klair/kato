<?php

namespace backend\widgets;

use Yii;
use yii\web\AssetBundle;

class MediaAsset extends AssetBundle
{

    public $sourcePath = '@mediaAsset/assets';

    public $css = [
        'media.css'
    ];

    public $js = [
        'media.js'
    ];

    public $depends = [
        '\kato\BowerAsset',
        '\dosamigos\editable\EditableSelect2Asset'
    ];
}