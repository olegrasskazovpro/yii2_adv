<?php
	
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/* @var $this yii\web\View */
	/* @var $model common\models\filters\UserSearch */
	/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">
	
	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>
	
	<?= $form->field($model, 'id') ?>
	
	<?= $form->field($model, 'username') ?>
	
	<?= $form->field($model, 'email') ?>
	
	<?= $form->field($model, 'password') ?>
	
	<?= $form->field($model, 'role_id') ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('mainButtons', 'search'), ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton(Yii::t('mainButtons', 'reset'), ['class' => 'btn btn-outline-secondary']) ?>
	</div>
	
	<?php ActiveForm::end(); ?>

</div>
