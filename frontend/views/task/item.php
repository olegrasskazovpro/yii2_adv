<?php
	
	use yii\helpers\Html;
	use \yii\widgets\DetailView;
	
	/* @var $this yii\web\View */
	/* @var $model common\models\tables\Tasks */
	/* @var $status \frontend\controllers\TasksController */
	/* @var $responsible \frontend\controllers\TasksController */
	
	$this->title = $model->title;
	$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
	\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'description',
		'responsible_id' => [
			'label' => 'ID ответственного',
			'value' => $model->responsible_id
			],
		'responsible_name' => [
			'label' => 'Имя ответственного',
			'value' => $responsible,
		],
		'deadline',
		'updated',
		'status' => [
			'label' => 'Статус',
			'value' => $status,
		],
		'created',
	],
])
?>

<p>
	<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('Delete', ['delete', 'id' => $model->id], [
		'class' => 'btn btn-danger',
		'data' => [
			'confirm' => 'Are you sure you want to delete this item?',
			'method' => 'post',
		],
	]) ?>
</p>