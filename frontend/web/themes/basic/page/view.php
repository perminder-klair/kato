<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\models\Page $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'title',
			'short_desc',
			'content_html:ntext',
			'slug',
			'status:boolean',
		],
	]); ?>

</div>
