<?php

namespace backend\components;

use Yii;
use yii\helpers\Html;

class View extends \yii\web\View
{
    public $description;
    public $pageIcon;

    /**
     * Register required components for admin theme
     */
    public function registerTheme()
    {
        $this->registerMetaTag([
            'charset' => Yii::$app->charset,
        ]);
        $this->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, nofollow',
        ]);
        $this->registerMetaTag([
            'name' => 'viewport',
            'content' => 'width=device-width,initial-scale=1,maximum-scale=1.0',
        ]);

        //Icons
        //The following icons can be replaced with your own, they are used by desktop and mobile browsers
        $this->registerLinkTag([
            'rel' => 'shortcut icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/favicon.ico',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon57.png',
            'sizes' => '57x57',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon72.png',
            'sizes' => '72x72',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon76.png',
            'sizes' => '76x76',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon114.png',
            'sizes' => '114x114',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon120.png',
            'sizes' => '120x120',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon144.png',
            'sizes' => '152x152',
        ]);
        $this->registerLinkTag([
            'rel' => 'apple-touch-icon',
            'href' => \Yii::$app->urlManager->baseUrl . '/img/icon152.png',
            'sizes' => '57x57',
        ]);

        //The Open Sans font is included from Google Web Fonts
        $this->registerLinkTag([
            'rel' => 'stylesheet',
            'href' => 'http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic',
        ]);
    }
}