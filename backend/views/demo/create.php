<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Demo $model
 */

$this->title = 'Create Demo';
$this->params['breadcrumbs'][] = ['label' => 'Demos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
