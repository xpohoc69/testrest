<?php

namespace app\controllers;

use app\forms\LoginForm;
use Exception;
use Yii;
use app\components\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
	public function actions(): array
	{
		return [
			'index' => [
				'class' => 'yii2mod\swagger\SwaggerUIRenderer',
				'restUrl' => Url::to(['site/json-schema']),
			],
			'json-schema' => [
				'class' => 'yii2mod\swagger\OpenAPIRenderer',
				// Тhe list of directories that contains the swagger annotations.
				'scanDir' => [
					Yii::getAlias('@app/api/common/controllers'),
				],
				'cache' => null
			],
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
}
