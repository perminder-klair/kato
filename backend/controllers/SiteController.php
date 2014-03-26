<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\VerbFilter;
use backend\models\Setting;
use yii\base\Model;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\HttpException;

class SiteController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\web\AccessControl::className(),
                'only' => ['index', 'settings', 'logout'],
				'rules' => [
					[
						'actions' => ['index', 'settings', 'logout'],
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
		];
	}

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kato\actions\UploadAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        $this->layout = 'fullWidth';

        if (($exception = Yii::$app->exception) === null) {
            return '';
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = $this->defaultName ?: Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }

    public function actionLogin()
    {
        $this->layout = 'fullWidth';

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
}
