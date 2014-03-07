<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\search\DemoSearch $searchModel
 */

$this->title = 'Demos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Demo', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'create_time',
			'update_time',
			'listing_order',
			// 'active',
			// 'deleted',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
