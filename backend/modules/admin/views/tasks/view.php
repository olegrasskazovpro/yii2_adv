<?php

use yii\helpers\Html;
use \yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $status \frontend\controllers\TasksController */
/* @var $responsible \frontend\controllers\TasksController */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main-Nav', 'tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'responsible_id',
		'responsible_name' => [
			'label' => Yii::t('main-Task', 'responsible'),
			'value' => $responsible,
		],
		'deadline',
		'updated',
		'status' => [
			'label' => Yii::t('main-Task', 'status'),
			'value' => $status,
		],
		'created',
	],
])
?>

<p>
	<?= Html::a(Yii::t('main-Buttons','update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a(Yii::t('main-Buttons', 'delete'), ['delete', 'id' => $model->id], [
		'class' => 'btn btn-danger',
		'data' => [
			'confirm' => Yii::t('main', 'confirm-delete'),
			'method' => 'post',
		],
	]) ?>
</p>