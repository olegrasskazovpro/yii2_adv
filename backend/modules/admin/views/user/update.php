<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\User */
/* @var $list \backend\controllers\UsersController[] */

$this->title = Yii::t('mainNav', 'update-user') . ': ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('mainNav', 'users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('mainNav', 'update');
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'list' => $list,
    ]) ?>

</div>
