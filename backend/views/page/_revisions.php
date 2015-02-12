<?php

use \Yii;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<?php if ($model->revisions): ?>
    <?= \yii\grid\GridView::widget([
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['id' => 'general-table', 'class' => 'table table-striped table-hover'],
        'showFooter' => true,
        'dataProvider' => $model->revisionsProvider(),
        'columns' => [
            'update_time',
            [
                'label' => 'Author',
                'format' => 'text',
                'value' => function ($data) {
                    if ($data->author) {
                        return $data->author->displayName;
                    }
                    return false;
                },
            ],
            [
                'label' => 'Actions',
                'format' => 'html',
                'value' => function ($data) {
                    $html = Html::a('Preview', Yii::$app->urlManagerFrontend->createUrl(['/page/preview', 'id' => $data->id]), ['class' => 'btn btn-info btn-xs', 'target' => '_blank']);
                    $html .= Html::a('Restore', ['restore', 'id' => $data->id], ['class' => 'btn btn-warning btn-xs']);
                    return Html::tag('div', $html, ['class' => 'btn-group']);
                },
            ],
        ],
    ]); ?>
<?php else: ?>
    <p>No revisions available!</p>
<?php endif; ?>