<?php

use yii\helpers\Html;

/**
 * @var $this \yii\web\View
 * @var $model common\models\tables\Tasks
 * @var $taskStatusList \backend\controllers\TasksController[]
 * @var $responsibleList \backend\controllers\TasksController[]
 */

$this->title = Yii::t('main-Nav', 'update-task') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main-Nav', 'tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('main-Nav', 'update');
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
      'model' => $model,
			'responsibleList' => $responsibleList,
			'taskStatusList' => $taskStatusList,
    ]) ?>

</div>
