<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Demo;
use frontend\models\search\DemoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\VerbFilter;

/**
 * DemoController implements the CRUD actions for Demo model.
 */
class DemoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\web\AccessControl::className(),
                'only' => ['admin', 'create', 'update', 'delete'],
                    'rules' => [
                    [
                        'actions' => ['admin', 'create', 'update', 'delete'], // Define specific actions
                        'allow' => true, // Has access
                        'roles' => ['admin'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
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
     * Lists all Demo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
    * Admin all Demo models.
    * @return mixed
    */
    public function actionAdmin()
    {
        $searchModel = new DemoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Demo model.
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
     * Creates a new Demo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Demo;

        if ($model->save(false)) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return false;
    }

    /**
     * Updates an existing Demo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '@backend/views/layouts/main';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Demo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Demo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Demo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if ($id !== null && ($model = Demo::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
