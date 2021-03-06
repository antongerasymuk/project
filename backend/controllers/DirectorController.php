<?php
namespace backend\controllers;

use common\models\Director;
use common\models\Company;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\ImageNameHelper;

/**
 * Company controller
 */
class DirectorController extends BackEndController
{
    public function actionIndex()
    {
        $directors = Director::find()->all();

        return $this->render('index', ['directors' => $directors]);
    }

    public function actionEdit($id)
    {
        $model = Director::findOne($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');

            if ($model->photoFile) {
                unlink(Url::to('@frontend/web') . $model->photo);
                $basePath =  ImageNameHelper::getImageName($model->photoFile);
                $path = Url::to($params['uploadPath']) . $basePath;

                // store the source file name
                $model->photo = $params['uploadUrl'] . $basePath ;
                $model->photoFile->saveAs($path);
            }

            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Director update success');

                return $this->redirect(['director/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new Director();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $photoFile = UploadedFile::getInstance($model, 'photoFile');
            $basePath =  ImageNameHelper::getImageName($model->photoFile);
            $path = Url::to($params['uploadPath']) . $basePath;

            // store the source file name
            $model->photo = $params['uploadUrl'] . $basePath ;

            if($model->save()) {
                $photoFile->saveAs($path);

                if ($isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                    return [
                        'success' => $model->id,
                        'item' => [
                            'id' => $model->id,
                            'value' => $model->title
                        ]
                    ];
                }

                Yii::$app->getSession()->setFlash('success', 'Director created success');

                return $this->redirect(['director/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete($id)
    {
       $model = Director::findOne($id);
       $modelCompany = Company::find()->where(['director_id' => $id])->all();
       $model->delete();
       
       foreach ($modelCompany as $company) {
           $company->director_id = NULL;
           $company->save(false);
         
       } 

       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['director/index']);
    }
}