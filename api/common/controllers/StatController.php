<?php
declare(strict_types=1);

namespace app\api\common\controllers;

use app\api\common\forms\StatCreateForm;
use app\api\common\repositories\contracts\StatRepositoryContract;
use app\components\ApiController;
use Yii;

/**
 * @SWG\Info(
 *   title="testrest",
 *   version="1.0.0"
 * )
 */
class StatController extends ApiController
{
	/**
	 * @var StatRepositoryContract
	 */
	private StatRepositoryContract $statRepository;

	public function __construct($id, $module, StatRepositoryContract $statRepository, $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->statRepository = $statRepository;
	}

	/**
	 * @SWG\Get(path="/api/v1/stat",
	 *     tags={"Статистика"},
	 *     summary="Получить статистику по странам",
	 *     @SWG\Response(
	 *         response = 200,
	 *         description = "Статистика посещений в виде ключ:значение",
	 *     	   @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="ru",
	 *                  type="integer",
	 *     				example="20"
	 *              ),
	 *     	  		@SWG\Property(
	 *                  property="en",
	 *                  type="integer",
	 *     				example="33"
	 *              ),
	 *          ),
	 *     ),
	 * )
	 */
	public function actionIndex()
	{
		$data = $this->statRepository->findAll();

		$result = [];
		$count = count($data);
		for ($i = 0; $i < $count; ($i += 2)) {
			$result[$data[$i]] = (int)$data[$i + 1];
		}

		return $result;
	}

	/**
	 * @SWG\Post(path="/api/v1/stat",
	 *     tags={"Статистика"},
	 *     summary="Добавить посещение в статистику",
	 *     @SWG\Parameter(
	 *          name="country",
	 *          description="Код страны, 2-3 символа на латинице",
	 *     	    type="string",
	 *          in="formData",
	 *          minLength=2,
	 *          maxLength=3,
	 *          required=true
	 *      ),
	 *     @SWG\Response(
	 *         response = 201,
	 *         description = "Успешное добавление"
	 *     ),
	 *     @SWG\Response(
	 *         response = 409,
	 *         description = "Ошибки валидации"
	 *     ),
	 * )
	 */
	public function actionCreate()
	{
		$form = new StatCreateForm();
		$form->load(Yii::$app->request->post(), '');
		if (!$form->validate()) {
			return $form;
		}
		$this->statRepository->add($form->country);

		Yii::$app->response->setStatusCode(201, 'Created');
	}
}