<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use backend\models\Media;
use yii\helpers\Url;

class MediaController extends \yii\web\Controller
{
    public $pageTitle = 'Media';
    public $pageIcon = 'fa fa-camera-retro';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete'],
                'rules' => [
                    [
                        'actions' => ['delete'],
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
     * Updates an existing Media model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->title = $model->id;
        $controllerName = $this->getUniqueId();

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'Update media';
        $meta['pageIcon'] = $this->pageIcon;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Media has been updated');
            return $this->redirect(Url::previous());
        } else {
            return $this->render('/global/update', [
                'model' => $model,
                'meta' => $meta,
                'controllerName' => $controllerName,
            ]);
        }
    }

    public function actionUpdateData($id)
    {
        if ($post = Yii::$app->request->post()) {
            $model = $this->findModel($id);
            $model->$post['name'] = $post['value'];
            if ($model->save(false)) {
                echo 'true';
                exit;
            }
        }
        echo 'false';
    }

    /**
     * Deletes an existing Media model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax) {
            echo 'true';
            exit;
        }

        Yii::$app->session->setFlash('success', 'Media has been deleted');

        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Media::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload()
    {
        $file = \Yii::$app->kato->mediaUpload('attachment', true);
        dump($file);
        exit;
    }

    public function actionListMedia()
    {
        $result = array();
        if ($media = Media::find()->all()) {
            foreach ($media as $data) {
                $result[] = array(
                    'thumb' => '/' . $data->source,
                    'image' => '/' . $data->source,
                    'title' => '/' . $data->filename,
                    //'filelink' => '/' . $data->source,
                );
            }
        }

        echo Json::encode($result);
    }

    public function actionRenderRow($id)
    {
        $this->layout = false;

        if ($media = $this->findModel($id)) {
            return $this->render('mediaRow', [
                'media' => $media,
                'isNew' => true,
            ]);
        }
        return '';
    }
}