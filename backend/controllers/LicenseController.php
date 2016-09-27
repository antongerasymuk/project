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
    public function actionCreate()
    {
        $model = new License();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $model->licenseFile = UploadedFile::getInstance($model, 'licenseFile');
            $path = Url::to($params['uploadPath']) . $model->licenseFile->baseName . '.' . $model->licenseFile->extension;

            // store the source file name
            $model->url = $params['uploadUrl'] . $model->licenseFile->baseName . '.' . $model->licenseFile->extension;

            if($model->save()) $model->licenseFile->saveAs($path);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return [
                'success' => $model->id,
                'item' => [
                    'id' => $model->id,
                    'value' => $model->title
                ]
            ];
        }

        return $this->render('create', ['model' => $model]);
    }
}