<?php
	$params = array_merge(
		require __DIR__ . '/../../common/config/params.php',
		require __DIR__ . '/../../common/config/params-local.php',
		require __DIR__ . '/params.php',
		require __DIR__ . '/params-local.php'
	);
	
	return [
		'id' => 'app-frontend',
		'basePath' => dirname(__DIR__),
		'bootstrap' => ['log'],
		'controllerNamespace' => 'frontend\controllers',
		'components' => [
			'request' => [
				'csrfParam' => '_csrf-frontend',
			],
			'user' => [
				'identityClass' => 'common\models\User',
				'enableAutoLogin' => true,
			],
			'log' => [
				'traceLevel' => YII_DEBUG ? 3 : 0,
				'targets' => [
					[
						'class' => 'yii\log\FileTarget',
						'levels' => ['error', 'warning'],
					],
				],
			],
			'errorHandler' => [
				'errorAction' => 'site/error',
			],
			'view' => [
				'theme' => [
					'basePath' => '@app/themes/14fev',
					'baseUrl' => '@web/themes/14fev',
					'pathMap' => [
//						'@app/views' => '@app/themes/14fev'
					]
				]
			],
			
			'urlManager' => [
				'enablePrettyUrl' => true,
				'showScriptName' => false,
				'rules' => [
					'task-edit/<id>' => 'task/one',
					'task' => 'task/index',
				],
			],
		
		],
		'params' => $params,
	];
