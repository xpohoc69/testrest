<?php

namespace app\components;

use yii\filters\ContentNegotiator;
use yii\web\Response;

class ApiController extends \yii\rest\Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
        ];
    }
}