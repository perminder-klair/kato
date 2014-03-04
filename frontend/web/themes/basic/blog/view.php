<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Blog $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			'short_desc',
			'content:ntext',
			'content_html:ntext',
			'slug',
			'tags:ntext',
			'create_time',
			'created_by',
			'update_time',
			'updated_by',
			'publish_time',
			'published_by',
			'is_revision',
			'parent_id',
			'status',
			'deleted',
		],
	]); ?>

</div>
