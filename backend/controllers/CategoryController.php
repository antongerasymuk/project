<?php
namespace backend\controllers;

use common\models\Categorie;
use Yii;
use yii\web\Request;

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

    public function actionEdit($id)
    {
        $model = Categorie::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Category updated success');

            return $this->redirect(['category/index']);
        }

        return $this->render('update', ['model' => $model]);
    }

     public function actionDelete($id)
    {
       $model = Categorie::findOne($id);
       $modelReview = Review::find()->where(['category_id' => $id])->all();
       $model->delete();
  
       foreach ($modelReview as $review) {
           $review->category_id = NULL;
           $review->save(false);
         
       } 
       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['category/index']);
    }

}