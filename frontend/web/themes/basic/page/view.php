<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

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
			'create_time',
			'created_by',
			'update_time',
			'updated_by',
			'level',
			'layout',
			'parent_id',
			'type',
			'status:boolean',
			'deleted:boolean',
		],
	]); ?>

</div>
