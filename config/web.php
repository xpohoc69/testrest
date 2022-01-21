<?php

$config = [
	'id'         => 'basic',
	'basePath'   => dirname(__DIR__),
	'bootstrap'  => [
		'log',
		\app\bootstrap\Di::class,
	],
	'name'       => 'testrest',
	'language'   => 'ru-RU',
	'timeZone'   => 'Europe/Moscow',
	'aliases'    => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'modules'    => [
		'v1' => [
			'class' => 'app\api\modules\v1\ApiModule',
		],
	],
	'components' => [
		'redis'        => [
			'class'    => 'yii\redis\Connection',
			'hostname' => 'redis',
			'port'     => 6379,
			'database' => 0,
		],
		'request'      => [
			'cookieValidationKey'    => 'gtj9ifaHu45klW80mkmIRUJOHBxE4Kks',
			'enableCookieValidation' => true,
			'enableCsrfValidation'   => true,
			'parsers'                => [
				'application/json' => 'yii\web\JsonParser',
			],
		],
		'cache'        => [
			'class' => 'yii\caching\FileCache',
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'log'          => [
			'traceLevel' => 3,
			'targets'    => [
				[
					'class'          => \yii\log\FileTarget::class,
					'levels'         => ['info', 'error', 'warning'],
					'logFile'        => '@runtime/logs/app.log',
					'logVars'        => [],
					'rotateByCopy'   => false,
					'enableRotation' => false,
				],
				[
					'class'          => \yii\log\FileTarget::class,
					'levels'         => ['error', 'warning'],
					'logFile'        => '@runtime/logs/error.log',
					'logVars'        => [],
					'rotateByCopy'   => false,
					'enableRotation' => false,
				],
			],
		],
		'user'         => [
			'class'           => 'app\components\User',
			'identityClass'   => 'app\models\User',
			'enableSession'   => false,
			'enableAutoLogin' => false,
			'autoRenewCookie' => false,
			'identityCookie'  => ['name' => '_identity', 'httpOnly' => true],
			'loginUrl'        => '/site/login',
		],
		'urlManager'   => [
			'enablePrettyUrl'     => true,
			'showScriptName'      => false,
			'enableStrictParsing' => true,
			'suffix'              => '',
			'normalizer'          => [
				'class'                  => 'yii\web\UrlNormalizer',
				'collapseSlashes'        => true,
				'normalizeTrailingSlash' => true,
			],
			'rules'               => [
				''                               => 'site/index',
				'site'                           => 'site/index',
				'site/index'                     => 'site/index',
				'site/json-schema'               => 'site/json-schema',
				'site/error'                     => 'site/error',
				'GET api/<module:[\w\-]+>/stat'  => '<module>/stat/index',
				'POST api/<module:[\w\-]+>/stat' => '<module>/stat/create',
			],
		],
		'formatter'    => [
			'locale'          => 'ru-RU',
			'defaultTimeZone' => 'Europe/Moscow',
			'dateFormat'      => 'dd.MM.yyyy',
			'datetimeFormat'  => 'dd.MM.yyyy HH:mm',
		],
	],
];

return $config;
