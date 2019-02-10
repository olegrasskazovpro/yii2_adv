<?php
use yii\helpers\Url;

/**
 * @var $model \common\models\tables\Tasks
 */
?>
<div class="task-container">
	<a class="task-prev-link" href="<?= Url::to(['task/one', 'id' => $model->id]) ?>">
		<div>
			<h4><?= $model->title ?></h4>
			<p><?= $model->description ?></p>
			<p><?= Yii::t('main-Task', 'responsible') . ': ' . $model->responsible->username ?></p>
			<p><?= Yii::t('main-Task', 'deadline') . ': ' . $model->deadline ?></p>
			<p><?= Yii::t('main-Task', 'created') . ': ' . $model->created ?></p>
			<p><?= Yii::t('main-Task', 'status') . ': ' . $model->taskStatus->title ?></p>
		</div>
	</a>
</div>