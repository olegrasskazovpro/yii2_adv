<?php
	
	return [
		'components' => [
			'db' => [
				'class' => 'yii\db\Connection',
				'dsn' => 'mysql:host=127.0.0.1;dbname=task_adv;port=3306',
				'username' => 'root',
				'password' => 'root',
				'charset' => 'utf8mb4',
			],
			'mailer' => [
				'class' => 'yii\swiftmailer\Mailer',
				'viewPath' => '@common/mail',
				// send all mails to a file by default. You have to set
				// 'useFileTransport' to false and configure a transport
				// for the mailer to send real emails.
				'useFileTransport' => true,
			],
		],
	];
