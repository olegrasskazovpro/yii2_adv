<?php
	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/**
	 * @var $dataProvider \frontend\controllers\TaskController
	 */
?>
	<p>
		<?= Html::a(Yii::t('main-Task', 'create-task'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

<?=
	
	\yii\widgets\ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => function ($model) {
			return \frontend\widgets\TaskPrev::widget(['model' => $model]);
		},
	]);
?>