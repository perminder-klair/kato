<?php

namespace backend\controllers;

use Yii;
use backend\models\Block;
use backend\models\search\BlockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    public $pageTitle = 'Block';
    public $pageIcon = 'fa fa-align-center';

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

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kato\actions\SirTrevorUploadAction',
            ],
        ];
    }

	/**
	 * Lists all Block models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new BlockSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        $controllerName = $this->getUniqueId();

        $getColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'parent',
            'update_time',
            'status',
            ['class' => 'kato\modules\media\ActionColumn'],
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
	 * Creates a new Block model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Block;
        $model->block_type = Block::TYPE_SIR_TREVOR;

        if ($model->save(false)) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return false;
	}

	/**
	 * Updates an existing Block model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
        $controllerName = $this->getUniqueId();

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'Update block';
        $meta['pageIcon'] = $this->pageIcon;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Block has been updated');
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
			return $this->render('/global/update', [
				'model' => $model,
                'meta' => $meta,
                'controllerName' => $controllerName,
			]);
		}
	}

	/**
	 * Deletes an existing Block model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Block has been deleted');
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Block model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Block the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if ($id !== null && ($model = Block::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
