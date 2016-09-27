<?php
namespace backend\controllers;

use common\models\Bonus;
use common\models\Bonuse;
use common\models\Company;
use common\models\Country;
use common\models\DepositMethod;
use common\models\Gallery;
use common\models\Minuse;
use common\models\Os;
use common\models\Pros;
use common\models\Rating;
use common\models\Review;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
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

            if ($previewFile) {
                $path = Url::to($params['uploadPath']) . $previewFile->baseName . '.' . $previewFile->extension;

                // store the source file name
                $model->preview = $params['uploadUrl'] . $previewFile->baseName . '.' . $previewFile->extension;

                if($model->save()) {
                    $previewFile->saveAs($path);
                    // save relations

                    $galleryFiles = UploadedFile::getInstances($model, 'gallery');

                    $galleryIds = [];

                    if ($galleryFiles) {
                        $galleryIds = Gallery::upload($galleryFiles);
                    }

                    foreach ($model->bonusIds as $id) {
                        $model->link('bonuses', Bonus::findOne(['id' => $id]));
                    }

                    foreach ($model->ratingIds as $id) {
                        $model->link('ratings', Rating::findOne(['id' => $id]));
                    }

                    foreach ($model->plusIds as $id) {
                        $model->link('pros', Pros::findOne(['id' => $id]));
                    }

                    foreach ($model->minusIds as $id) {
                        $model->link('minuses', Minuse::findOne(['id' => $id]));
                    }

                    foreach ($model->depositIds as $id) {
                        $model->load('deposits', DepositMethod::findOne(['id' => $id]));
                    }

                    foreach ($model->osIds as $id) {
                        $model->load('oses', Os::findOne(['id' => $id]));
                    }

                    foreach ($model->allowedIds as $id) {
                        $model->load('allowed', Country::findOne(['id' => $id]));
                    }

                    foreach ($model->deniedIds as $id) {
                        $model->load('denied', Country::findOne(['id' => $id]));
                    }
                }
            } else {
                $model->addError('previewFile', 'Preview file not choose');
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return [
                'success' => $model->id,
                'item' => [
                    'id' => $model->id,
                    'value' => $model->title,
                    'gallery' => $galleryIds
                ]
            ];
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit()
    {
    }
}