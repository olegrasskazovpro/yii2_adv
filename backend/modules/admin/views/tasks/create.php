<?php
	
	use yii\helpers\Html;
	
	/**
	 * @var $this yii\web\View
	 * @var $model common\models\tables\Tasks
	 * @var $responsibleList \backend\controllers\TasksController[]
	 * @var $taskStatusList \backend\controllers\TasksController[]
	 */
	
	$this->title = Yii::t('main-Nav', 'create-task');
	$this->params['breadcrumbs'][] = ['label' => Yii::t('main-Nav', 'tasks'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

	<h1><?= Html::encode($this->title) ?></h1>
	
	<?= $this->render('_form', [
		'model' => $model,
		'responsibleList' => $responsibleList,
		'taskStatusList' => $taskStatusList,
	]) ?>

</div>
