<?php
declare(strict_types=1);

namespace app\bootstrap;

use app\api\common\repositories\contracts\StatRepositoryContract;
use app\api\common\repositories\redis\StatRepository;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Class Di
 *
 * @package common\bootstrap
 */
class Di implements BootstrapInterface
{

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

		$container->setSingleton(
			StatRepositoryContract::class,
			static function () {
				return new StatRepository(Yii::$app->redis);
			}
		);

	}
}
