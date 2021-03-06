<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserProfile;
use common\models\search\User as UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $pageTitle = 'User';
    public $pageIcon = 'fa fa-user';

	public function behaviors()
	{
		return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'], // Define specific actions
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
        $controllerName = $this->getUniqueId();
		$searchModel = new UserSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $getColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email',
            'create_time',
            ['class' => 'backend\components\ActionColumn'],
        ];

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'List all posts';
        $meta['pageIcon'] = $this->pageIcon;

		return $this->render('/global/index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
            'controllerName' => $controllerName,
            'meta' => $meta,
            'getColumns' => $getColumns,
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new User;
        $profile = new UserProfile();

        if ($model->save(false)) {
            //Create empty user profile row
            $profile->register($model->id);

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return false;
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
        $controllerName = $this->getUniqueId();
		$model = $this->findModel($id);
        $profile = UserProfile::find()
            ->where(['user_id' => $model->id])
            ->one();

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'Update user';
        $meta['pageIcon'] = $this->pageIcon;

		if (($model->load(Yii::$app->request->post()) && $model->save()) || ($profile->load(Yii::$app->request->post()) && $profile->save())) {
            Yii::$app->session->setFlash('success', 'User has been updated');
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
                'profile' => $profile,
                'meta' => $meta,
                'controllerName' => $controllerName,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'User has been deleted');
		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if ($id !== null && ($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
