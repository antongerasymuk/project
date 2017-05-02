<?php
namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
abstract class BackEndController extends Controller
{

    public $layout = 'admin';
    /**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
                    [
						'allow' => true,
						'roles' => ['@'],
					],
				]
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
}
