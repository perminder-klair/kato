<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\BlogSearch $searchModel
 */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
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
			// 'tags:ntext',
			// 'create_time',
			// 'created_by',
			// 'update_time',
			// 'updated_by',
			// 'publish_time',
			// 'published_by',
			// 'is_revision',
			// 'parent_id',
			// 'status',
			// 'deleted',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
