<?php
/**
 * @var $model \common\models\tables\Tasks
 * @var $userList \frontend\controllers\SiteController[]
 * @var $statusList \frontend\controllers\SiteController[]
 */
$form = \yii\widgets\ActiveForm::begin(['id' => 'task-create-form']);

echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'description')->textarea();
echo $form->field($model, 'responsible_id')->dropDownList($userList, ['prompt' => Yii::t('main-Forms', 'choose')]);
echo $form->field($model, 'deadline')
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
				]);
echo $form->field($model, 'status')->dropDownList($statusList, ['prompt' => Yii::t('main-Forms', 'choose')]);
echo \yii\helpers\Html::submitButton(Yii::t('main-Buttons', 'save'), ['class' => ['btn btn-success']]);

\yii\widgets\ActiveForm::end();
?>