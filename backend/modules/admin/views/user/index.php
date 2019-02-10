<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\filters\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $role \common\models\tables\Roles */

$this->title = Yii::t('mainNav', 'users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('mainButtons', 'create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'password',
						'role_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
