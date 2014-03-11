<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\search\BlockSearch $searchModel
 */

$this->title = 'Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Block', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'slug',
			'content:ntext',
			'content_html:ntext',
			// 'create_time',
			// 'created_by',
			// 'update_time',
			// 'updated_by',
			// 'parent',
			// 'listing_order',
			// 'status',
			// 'deleted',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
