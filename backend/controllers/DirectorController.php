<?php
namespace backend\controllers;

use common\models\Director;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

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
                $path = Url::to($params['uploadPath']) . $model->photoFile->baseName . '.' . $model->photoFile->extension;

                // store the source file name
                $model->photo = $params['uploadUrl'] . $model->photoFile->baseName . '.' . $model->photoFile->extension;
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
            $path = Url::to($params['uploadPath']) . $photoFile->baseName . '.' . $photoFile->extension;

            // store the source file name
            $model->photo = $params['uploadUrl'] . $photoFile->baseName . '.' . $photoFile->extension;

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
}