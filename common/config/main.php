<?php
	return [
		'language' => 'en',
		'bootstrap' => ['log', 'bootstrap'],
		'aliases' => [
			'@bower' => '@vendor/bower-asset',
			'@npm' => '@vendor/npm-asset',
			'@img' => '@frontend/web/img',
		],
		'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
		'modules' => [
			'admin' => [
				'class' => 'backend\modules\admin\Module',
			],
			'rbac' => [
				'class' => 'yii2mod\rbac\Module',
				'controllerMap' => [
					'assignment' => [
						'class' => 'yii2mod\rbac\controllers\AssignmentController',
						'userIdentityClass' => \common\models\tables\User::class, // тут указал класс таблицы пользователей
						'searchClass' => [
							'class' => 'yii2mod\rbac\models\search\AssignmentSearch',
							'pageSize' => 10,
						],
						'idField' => 'id',
						'usernameField' => 'username', // тут указал как у меня в БД называется поле с именем юзера
						'gridViewColumns' => [
							'id',
							'username', // аналогично
							'email'
						],
					],
				],
			],
		],
		'components' => [
			'bootstrap' => [
				'class' => \common\components\Bootstrap::class,
			],
			'cache' => [
				'class' => 'yii\caching\FileCache',
			],
			'authManager' => [
				'class' => 'yii\rbac\DbManager',
				'defaultRoles' => ['guest', 'user'],
			],
			'i18n' => [
				'translations' => [
					'main*' => [
						'class' => \yii\i18n\PhpMessageSource::class,
						'basePath' => '@common/messages',
					],
					'yii2mod.rbac' => [
						'class' => 'yii\i18n\PhpMessageSource',
						'basePath' => '@yii2mod/rbac/messages',
					],
				]
			],
		],
	];
