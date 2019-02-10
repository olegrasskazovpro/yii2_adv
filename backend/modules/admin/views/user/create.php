<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\User */
/* @var $list \backend\controllers\UserController[] */

$this->title = Yii::t('mainNav', 'create-user');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mainNav', 'users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'list' => $list,
    ]) ?>

</div>
