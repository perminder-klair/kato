<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\VerbFilter;
use backend\models\Setting;
use yii\base\Model;

class SiteController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\web\AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error', 'upload'],
						'allow' => true,
                        'roles' => ['?'],
					],
					[
						'actions' => ['logout', 'index', 'login', 'error', 'settings', 'upload', 'makeadmin'],
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
		];
	}

    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSettings()
    {
        $settings = Setting::find()->indexBy('id')->all();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->save(false);
            }

            return $this->redirect('settings');
        }

        return $this->render('settings', ['settings' => $settings]);
    }

    public function actionUpload()
    {
        //If any media upload catch it and upload it
        $mediaJson = \Yii::$app->kato->mediaUpload();

        $media = \yii\helpers\Json::decode($mediaJson);

        if (isset($_GET['content_id'])) {
            if (is_array($media)) {
                //Do join here
                $contentMedia = new \backend\models\ContentMedia();
                $contentMedia->content_id = $_GET['content_id'];
                if (isset($_GET['media_type'])) $contentMedia->media_type = $_GET['media_type'];
                $contentMedia->media_id = $media['id'];
                $contentMedia->save(false);
            }
        }

        return $mediaJson;
    }

    public function actionMakeadmin()
    {
        $r=new \yii\rbac\DbManager;
        $r->init();
        $r->createRole("admin","Administrator");
        $r->save();

        $r->assign('1','admin');
    }
}
