<?php

namespace app\api\modules\v1;

use yii\base\Module;

class ApiModule extends Module
{
    public function init()
    {
		parent::init();
        \Yii::$app->user->enableSession = false;
    }
}