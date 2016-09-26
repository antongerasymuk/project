<?php
namespace backend\controllers;

use common\models\Bonuse;
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

            if($model->save()) {
                $previewFile->saveAs($path);

                // save relations

                foreach ($model->bonusIds as $id) {
                    $model->link('bonuses', Review::findOne(['id' => $id]));
                }

                foreach ($model->ratingIds as $id) {
                    $model->link('ratings', Review::findOne(['id' => $id]));
                }
            }
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

    public function actionEdit()
    {
    }
}