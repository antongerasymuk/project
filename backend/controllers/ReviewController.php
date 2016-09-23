<?php
namespace backend\controllers;

use common\models\Company;
use common\models\Review;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class ReviewController extends BackEndController
{
    public function actionIndex()
    {

    }

    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $previewFile = UploadedFile::getInstance($model, 'previewFile');
            $path = Url::to($params['uploadPath']) . $previewFile->baseName . '.' . $previewFile->extension;

            // store the source file name
            $model->preview = $params['uploadUrl'] . $previewFile->baseName . '.' . $previewFile->extension;

            if($model->save()) $previewFile->saveAs($path);
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ['success' => $model->id];
        }

        return $this->renderAjax('create', ['model' => $model]);
    }

    public function editCreate()
    {

    }
}