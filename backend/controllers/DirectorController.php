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
    public function actionCreate()
    {
        $model = new Director();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $photoFile = UploadedFile::getInstance($model, 'photoFile');
            $path = Url::to($params['uploadPath']) . $photoFile->baseName . '.' . $photoFile->extension;

            // store the source file name
            $model->photo = $params['uploadUrl'] . $photoFile->baseName . '.' . $photoFile->extension;

            if($model->save()) $photoFile->saveAs($path);
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