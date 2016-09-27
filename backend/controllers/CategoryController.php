<?php
namespace backend\controllers;

use common\models\Categorie;
use Yii;

/**
 * Company controller
 */
class CategoryController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'categories' => Categorie::find()->all()
        ]);
    }

    public function actionCreate()
    {
        $model = new Categorie();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Category created success');

            return $this->redirect(['category/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

}