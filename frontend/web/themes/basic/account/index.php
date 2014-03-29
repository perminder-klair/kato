<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $user
 */
$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($user->username) ?> - <?= Html::encode($this->title) ?></h1>

    <p>Secured members area.</p>

</div>
