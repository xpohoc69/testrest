<?php
declare(strict_types=1);

namespace app\api\common\repositories\redis;

use app\api\common\repositories\contracts\StatRepositoryContract;
use yii\redis\Connection;

class StatRepository implements StatRepositoryContract
{
	private Connection $storage;
	private const STAT_KEY = 'stat';

	public function __construct($storage)
	{
		$this->storage = $storage;
	}

	public function add(string $country): bool
	{
		$count = $this->storage->hincrby(self::STAT_KEY, $country, 1);

		return is_integer($count);
	}

	public function findAll(): array
	{
		return $this->storage->hgetall(self::STAT_KEY);
	}
}