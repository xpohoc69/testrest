<?php
declare(strict_types=1);

namespace app\api\common\forms;

class StatCreateForm extends \yii\base\Model
{
	public $country;

	public function rules()
	{
		return [
			['country', 'trim'],
			['country', 'required'],
			['country', 'match', 'pattern' => '/^[a-z]{2,3}$/']
		];
	}

}