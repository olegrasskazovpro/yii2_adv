<?php
	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/**
	 * @var $this yii\web\View
	 * @var $model common\models\tables\Tasks
	 * @var $form yii\widgets\ActiveForm
	 * @var $responsibleList \frontend\controllers\TasksController[]
	 * @var $taskStatusList \frontend\controllers\TasksController[]
	 */
	
?>

<div class="tasks-form">
	
	<?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'responsible_id')
		->dropDownList($responsibleList, ['prompt' => Yii::t('main-Forms', 'choose')]) ?>

	<?= $form->field($model, 'deadline')
				->widget(\kartik\datetime\DateTimePicker::class, [
					'name' => 'datetime_10',
					'options' => ['placeholder' => Yii::t('main-Task', 'select-deadline')],
					'convertFormat' => true,
					'pluginOptions' => [
						'language' => Yii::$app->session->get('lang'),
						'autoclose' => true,
						'todayHighlight' => true,
						'todayBtn' => true,
						'format' => 'yyyy-MM-dd H:i:00',
						'startDate' => date('yyyy-MM-dd H:i:00'),
						'todayHighlight' => true
					]
				]) ?>
	
	<?= $form->field($model, 'status')
		->dropDownList($taskStatusList, ['prompt' => Yii::t('main-Forms', 'choose')]) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('main-Buttons', 'save'), ['class' => 'btn btn-success']) ?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
