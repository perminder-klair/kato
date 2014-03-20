<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
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
			'title',
			'short_desc',
			'content_html:ntext',
			'tags:ntext',
			'publish_time',
			'published_by',
		],
	]); ?>

</div>
