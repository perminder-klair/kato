<?php

namespace backend\controllers;

use common\models\Blog;
use common\models\search\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
	public function behaviors()
	{
		return [
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
		$dataProvider = $searchModel->search($_GET);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Blog model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
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

		if ($model->load($_POST) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
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
		return $this->redirect(['index']);
	}

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
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
