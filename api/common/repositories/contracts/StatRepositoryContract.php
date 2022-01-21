<?php
declare(strict_types=1);

namespace app\api\common\repositories\contracts;

interface StatRepositoryContract
{
	public function add(string $country): bool;

	public function findAll(): array;
}