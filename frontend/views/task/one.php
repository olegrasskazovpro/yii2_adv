<?php
	
	use frontend\assets\TaskOneAsset;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ActiveForm;
	use kartik\datetime\DateTimePicker;
	
	/* @var $this yii\web\View */
	/* @var $model common\models\tables\Tasks */
	
	$this->title = $model->title;
	$this->params['breadcrumbs'][] = ['label' => Yii::t('main-Nav', 'tasks'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	\yii\web\YiiAsset::register($this);
	TaskOneAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="task-edit">
	<?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>
	<?= $form->field($model, 'title')->textInput(); ?>
	<div class="row">
		<div class="col-lg-4">
			<?= $form->field($model, 'status')->dropDownList($statusList) ?>
		</div>
		<div class="col-lg-4">
			<?= $form->field($model, 'responsible_id')->dropDownList($userList) ?>
		</div>
		<div class="col-lg-4">
			<?= $form->field($model, 'deadline')
				->widget(DateTimePicker::class, [
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
		</div>
		<div class="col-lg-4"></div>
	</div>
	<?= $form->field($model, 'description')->textarea(); ?>
	<?= Html::submitButton(Yii::t('main-Buttons', 'save'), ['class' => 'btn btn-primary']); ?>
	
	<?php ActiveForm::end() ?>

	<button id="my-btn" class="btn btn-danger">Нажми меня</button>

</div>
<hr>
<div>
	<h2><?= Yii::t('main-Task', 'attachments') ?></h2>
	<?=
		\yii\widgets\ListView::widget([
			'dataProvider' => $imgDataProvider,
			'summary' => '',
			'itemView' => function ($model) {
				return \frontend\widgets\Attachment::widget(['model' => $model]);
			},
			'options' => [
				'class' => 'attachment',
			]
		]);
	?>
	
	<?php
		/**
		 * @var $modelUpload \common\models\tables\TaskAttachments
		 * @var $userId int
		 * @var $userList []
		 * @var $statusList []
		 */
		
		if (Yii::$app->user->can('AddAttachment')) {
			$form = \yii\widgets\ActiveForm::begin(['action' => Url::to(['task/add-file']), 'id' => 'file']);
			echo Html::activeHiddenInput($modelUpload, 'task_id', ['value' => $model->id]);
			echo $form->field($modelUpload, 'file')
				->fileInput()
				->label(Yii::t('main-Task', 'add-attachment'));
			echo \yii\helpers\Html::submitButton(Yii::t('main-Buttons', 'send'), ['class' => ['btn btn-success']]);
			
			\yii\widgets\ActiveForm::end();
		}
	?>
</div>
<hr>
<div>
	<h2><?= Yii::t('main-Task', 'comments') ?></h2>
	<?=
		\yii\widgets\ListView::widget([
			'dataProvider' => $dataProvider,
			'summary' => '',
			'itemView' => function ($model) {
				return \frontend\widgets\Comment::widget(['model' => $model]);
			},
			'options' => [
				'class' => 'comment',
			]
		]);
	?>
	
	<?php
		/**
		 * @var $modelComment \common\models\tables\TaskComments
		 * @var $userId int
		 * @var $userList []
		 * @var $statusList []
		 */
		
		if (Yii::$app->user->can('AddComment')) {
			$form = \yii\widgets\ActiveForm::begin(['action' => Url::to(['task/add-comment']), 'id' => 'comment']);
			
			echo Html::activeHiddenInput($modelComment, 'user_id', ['value' => $userId]);
			echo Html::activeHiddenInput($modelComment, 'task_id', ['value' => $model->id]);
			echo $form->field($modelComment, 'comment')->textarea()->label(Yii::t('main-Task', 'add-comment'));
			echo \yii\helpers\Html::submitButton(Yii::t('main-Buttons', 'addComment'), ['class' => ['btn btn-success']]);
			
			\yii\widgets\ActiveForm::end();
		}
	?>
</div>