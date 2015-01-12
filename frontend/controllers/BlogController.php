<?php

namespace frontend\controllers;

use Yii;
use backend\models\Blog;
use backend\models\search\BlogSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BlogController extends \yii\web\Controller
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
        $model = new Blog();

        $searchModel = new BlogSearch;
        $getQuery = Yii::$app->request->getQueryParams();
        $getQuery['BlogSearch']['status'] = Blog::STATUS_PUBLISHED;
        //TODO by publish time

        $dataProvider = $searchModel->search($getQuery);

        return $this->render('index', [
            'model' => $model,
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
        $model = $this->findModel($id);

        //dump($model->media[0]->render());exit;

        return $this->render('view', [
            'model' => $model,
        ]);
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
