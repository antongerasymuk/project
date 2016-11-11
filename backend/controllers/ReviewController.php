<?php
namespace backend\controllers;

use common\models\Bonus;
use common\models\Category;
use common\models\Country;
use common\models\DepositMethod;
use common\models\Gallery;
use common\models\Minuse;
use common\models\Os;
use common\models\Plus;
use common\models\Rating;
use common\models\Review;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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

    public function actionCreate($isAjax = true)
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
                   

                    if (!empty($galleryIds)) {
                        foreach ($galleryIds as $id) {
                            $model->link('galleries', Gallery::findOne($id));
                        }
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
                            $model->link('deposits', DepositMethod::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->osIds)) {
                        foreach ($model->osIds as $id) {
                            $model->link('oses', Os::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->allowedIds)) {
                        foreach ($model->allowedIds as $id) {
                            $model->link('allowed', Country::findOne(['id' => $id]));
                        }
                    }

                    if (!empty($model->deniedIds)) {
                        foreach ($model->deniedIds as $id) {
                            $model->link('denied', Country::findOne(['id' => $id]));
                        }
                    }
                }
            } else {
                $model->addError('previewFile', 'Preview file not choose');
            }

            if ($isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return [
                    'success' => $model->id,
                    'item' => [
                        'id' => $model->id,
                        'value' => $model->title,
                    ]
                ];
            }

            Yii::$app->getSession()->setFlash('success', 'Review create success');

            return $this->redirect(['review/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Review::findOne($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $model->previewFile = UploadedFile::getInstance($model, 'previewFile');
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            $params = Yii::$app->params;

            if ($model->previewFile) {
                unlink(Url::to('@frontend/web') . $model->preview);
                $previewPath = Url::to($params['uploadPath']) . $model->previewFile->baseName . '.' . $model->previewFile->extension;
                $model->preview = $params['uploadUrl'] . $model->previewFile->baseName . '.' . $model->previewFile->extension;
                $model->previewFile->saveAs($previewPath);
            }

            if ($model->logoFile) {
                unlink(Url::to('@frontend/web') . $model->logo);
                $logoPath = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logo = $params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logoFile->saveAs($logoPath);
            }

            $galleryIds = [];
            $galleryFiles = UploadedFile::getInstances($model, 'gallery');

            if ($galleryFiles) {
                $model->unlinkAll('galleries', true);
                $galleryIds = Gallery::upload($galleryFiles);
                
            }
            if (!empty($galleryIds)) {
                foreach ($galleryIds as $id) {
                    $model->link('galleries', Gallery::findOne($id));
                }
            }
          
            if (!empty($model->bonusIds)) {
                // untouch bonuses
                foreach ($model->bonuses as $bonus) {
                    $bonus->review_id = null;
                    $bonus->update(true, ['review_id']);
                }

                foreach ($model->bonusIds as $id) {
                    $bonus = Bonus::findOne($id);
                    $bonus->review_id = $model->id;
                    $bonus->update(true, ['review_id']);
                }
            }

            if (!empty($model->ratingIds)) {
                $model->unlinkAll('ratings');

                foreach ($model->ratingIds as $id) {
                    $model->link('ratings', Rating::findOne(['id' => $id]));
                }
            }

            if (!empty($model->plusIds)) {
                $model->unlinkAll('pluses');

                foreach ($model->plusIds as $id) {
                    $model->link('pluses', Plus::findOne(['id' => $id]));
                }
            }

            if (!empty($model->minusIds)) {
                $model->unlinkAll('minuses');

                foreach ($model->minusIds as $id) {
                    $model->link('minuses', Minuse::findOne(['id' => $id]));
                }
            }

            if (!empty($model->depositIds)) {
                $model->unlinkAll('deposits');

                foreach ($model->depositIds as $id) {
                    $model->link('deposits', DepositMethod::findOne(['id' => $id]));
                }
            }

            if (!empty($model->osIds)) {
                $model->unlinkAll('oses');

                foreach ($model->osIds as $id) {
                    $model->link('oses', Os::findOne(['id' => $id]));
                }
            }

            if (!empty($model->allowedIds)) {
                $model->unlinkAll('allowed');

                foreach ($model->allowedIds as $id) {
                    $model->link('allowed', Country::findOne(['id' => $id]));
                }
            }

            if (!empty($model->deniedIds)) {
                $model->unlinkAll('denied');

                foreach ($model->deniedIds as $id) {
                    $model->link('denied', Country::findOne(['id' => $id]));
                }
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Review update success');

                return $this->redirect(['review/index']);
            }
        }

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

        return $this->render('update', ['model' => $model]);
    }
    public function actionDelete($id)
    {
        $model = Review::findOne($id);
        $model->delete();
        $model->unlinkAll('ratings', true);
        $model->unlinkAll('pluses', true);
        $model->unlinkAll('minuses', true);
        $model->unlinkAll('oses', true);
        $model->unlinkAll('allowed', true);
        $model->unlinkAll('denied', true);
        $model->unlinkAll('galleries', true);

       $modelBonus = Bonus::find()->where(['review_id' => $id])->all();
       foreach ($modelBonus as $bonus) {
           $bonus->review_id = NULL;
           $bonus->save(false);
         
       } 

       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['review/index']);
    }

}