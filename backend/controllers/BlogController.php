<?php

namespace backend\controllers;

use Yii;
use common\models\Blog;
use common\models\search\Blog as BlogSearch;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;
use yii\grid\DataColumn;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends \yii\web\Controller
{
    public $pageTitle = 'Blog';
    public $pageIcon = 'fa fa-book';

	public function behaviors()
	{
		return [
            'access' => [
                'class' => \yii\web\AccessControl::className(),
                //'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'], // Define specific actions
                        'allow' => true, // Has access
                        'roles' => ['admin'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
                    ],
                    [
                        'allow' => false, // Do not have access
                        'roles'=>['?'], // Guests '?'
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
	 * Lists all Blog models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new BlogSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $getColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'class' => DataColumn::className(),
                'attribute' => 'authorName',
                'format' => 'text',
                'label' => 'Author',
            ],
            'update_time',
            'publish_time',
            [
                'class' => DataColumn::className(),
                'attribute' => 'statusLabel',
                'format' => 'text',
                'label' => 'Status',
            ],
            ['class' => 'backend\components\ActionColumn'],
        ];

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'List all posts';
        $meta['pageIcon'] = $this->pageIcon;

		return $this->render('/global/index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
            'meta' => $meta,
            'getColumns' => $getColumns,
		]);
	}

	/**
	 * Creates a new Blog model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Blog;

		if ($model->save(false)) {
			return $this->redirect(['update', 'id' => $model->id]);
		}

        return false;
	}

	/**
	 * Updates an existing Blog model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'Update post';
        $meta['pageIcon'] = $this->pageIcon;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Post has been updated');
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
			return $this->render('/global/update', [
				'model' => $model,
                'meta' => $meta,
			]);
		}
	}

	/**
	 * Deletes an existing Blog model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
        $model = $this->findModel($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Post has been deleted');

		return $this->redirect(['index']);
	}

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param $id
     * @param array $withList
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id, $withList = [])
    {
        $query = Blog::find()
            ->where(['id' => $id])
            ->with('user');

        foreach ($withList as $with) {
            $query->with($with);
        }

        $model = $query->one();

        if ($model === null)
            throw new NotFoundHttpException('The requested page does not exist.');

        return $model;
    }
}
