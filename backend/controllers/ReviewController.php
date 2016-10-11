<?php
namespace backend\controllers;

use common\helpers\ModelMapHelper;
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
use yii\helpers\ArrayHelper;
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
        $reviews = Review::find()->all();

        return $this->render('index', ['reviews' => $reviews]);
    }

    public function actionCreate()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $model->previewFile = UploadedFile::getInstance($model, 'previewFile');
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($model->previewFile && $model->logoFile) {
                $previewPath = Url::to($params['uploadPath']) . $model->previewFile->baseName . '.' . $model->previewFile->extension;
                $logoPath = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                // store the source file name
                $model->preview = $params['uploadUrl'] . $model->previewFile->baseName . '.' . $model->previewFile->extension;
                $model->logo = $params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                if($model->save()) {
                    $model->previewFile->saveAs($previewPath);
                    $model->logoFile->saveAs($logoPath);
                    // save relations

                    $galleryFiles = UploadedFile::getInstances($model, 'gallery');

                    $galleryIds = [];

                    if ($galleryFiles) {
                        $galleryIds = Gallery::upload($galleryFiles);
                    }

                    if (!empty($model->bonusIds)) {
                        foreach ($model->bonusIds as $id) {
                            $bonus = Bonus::findOne($id);
                            $bonus->review_id = $model->id;
                            $bonus->update(true, ['review_id']);
                        }
                    }

                    if (!empty($model->ratingIds)) {
                        foreach ($model->ratingIds as $id) {
                            $model->link('ratings', Rating::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->plusIds)) {
                        foreach ($model->plusIds as $id) {
                            $model->link('pluses', Plus::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->minusIds)) {
                        foreach ($model->minusIds as $id) {
                            $model->link('minuses', Minuse::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->depositIds)) {
                        foreach ($model->depositIds as $id) {
                            $model->load('deposits', DepositMethod::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->osIds)) {
                        foreach ($model->osIds as $id) {
                            $model->load('oses', Os::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->allowedIds)) {
                        foreach ($model->allowedIds as $id) {
                            $model->load('allowed', Country::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->deniedIds)) {
                        foreach ($model->deniedIds as $id) {
                            $model->load('denied', Country::findOne(['id' => $id]));
                        }
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
                ]
            ];
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Review::findOne($id);

        $model->bonusIds = ArrayHelper::map($model
            ->getBonuses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->ratingIds = ArrayHelper::map($model
            ->getRatings()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->plusIds = ArrayHelper::map($model
            ->getPluses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->minusIds = ArrayHelper::map($model
            ->getMinuses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->depositIds = ArrayHelper::map($model
            ->getDeposits()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->osIds = ArrayHelper::map($model
            ->getOses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->allowedIds = ArrayHelper::map($model
            ->getAllowed()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        $model->deniedIds = ArrayHelper::map($model
            ->getDenied()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

//        var_dump($model->bonusIds);
//        var_dump(ModelMapHelper::getIdTitleMap(\common\models\Bonus::class));

        return $this->render('update', ['model' => $model]);
    }
}