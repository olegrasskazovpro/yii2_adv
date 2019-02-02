<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
			'user' => [
				'identityCookie' => ['name' => '_identity-common', 'httpOnly' => true],
			],
			'session' => [
				// this is the name of the session cookie used for login on the backend
				'name' => 'advanced-common',
			],
    ],
];
