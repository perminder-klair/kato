<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use yii\web\VerbFilter;

class SiteController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\web\AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
                        'roles' => ['?'],
					],
					[
						'actions' => ['logout', 'index', 'login', 'error', 'makeadmin'],
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

    public function actionMakeadmin()
    {
        $r=new \yii\rbac\DbManager;
        $r->init();
        $r->createRole("admin","Administrator");
        $r->save();

        $r->assign('1','admin');
    }
}
