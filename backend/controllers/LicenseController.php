<?php
namespace backend\controllers;

use common\models\License;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class LicenseController extends BackEndController
{
    public function actionIndex()
    {
        $licenses = License::find()->all();

        return $this->render('index', ['licenses' => $licenses]);
    }

    public function actionEdit($id)
    {
        $model = License::findOne($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $model->licenseFile = UploadedFile::getInstance($model, 'licenseFile');

            if ($model->licenseFile) {
                unlink(Url::to('@frontend/web') . $model->url);
                $path = Url::to($params['uploadPath']) . $model->licenseFile->baseName . '.' . $model->licenseFile->extension;
                // store the source file name
                $model->url = $params['uploadUrl'] . $model->licenseFile->baseName . '.' . $model->licenseFile->extension;
                $model->licenseFile->saveAs($path);
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'License update success');

                return $this->redirect(['license/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new License();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

            Yii::$app->getSession()->setFlash('success', 'License created success');

            return $this->redirect(['license/index']);
        }

        return $this->render('create', ['model' => $model]);
    }
}