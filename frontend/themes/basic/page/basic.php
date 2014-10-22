<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Page;

/**
 * @var backend\components\View $this
 * @var backend\models\Page $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

	<h1><?= Html::encode($this->title) ?></h1>

    <?php echo \Yii::$app->kato->getBlock('details', $model->id, $model->layout); ?>

</div>
