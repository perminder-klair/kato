<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PageSearch $searchModel
 */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'short_desc',
			'content:ntext',
			'content_html:ntext',
			// 'slug',
			// 'create_time',
			// 'created_by',
			// 'update_time',
			// 'updated_by',
			// 'level',
			// 'layout',
			// 'parent_id',
			// 'type',
			// 'status:boolean',
			// 'deleted:boolean',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
