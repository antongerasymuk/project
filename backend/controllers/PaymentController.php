<?php
namespace backend\controllers;

use common\models\DepositMethod;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\helpers\ImageNameHelper;

/**
 * Company controller
 */
class PaymentController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'payments' => DepositMethod::find()->all()
        ]);
    }

    public function actionCreate($isAjax = true)
    {
        $model = new DepositMethod();

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            if ($model->logoFile) {
                $basePath =  ImageNameHelper::getImageName($model->logoFile);
                $path = Url::to(Yii::$app->params['uploadPath']) . $basePath;

                // store the source file name
                $model->logo = Url::to(Yii::$app->params['uploadUrl']) . $basePath;

                if($model->save()){
                    $model->logoFile->saveAs($path);

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

                    Yii::$app->getSession()->setFlash('success', 'Payment method created success');

                    return $this->redirect(['payment/index']);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = DepositMethod::findOne($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($model->logoFile) {
                unlink(Url::to('@frontend/web') . $model->logo);
                $basePath =  ImageNameHelper::getImageName($model->logoFile);
                $path = Url::to(Yii::$app->params['uploadPath']) . $basePath;
                // store the source file name
                $model->logo = Url::to(Yii::$app->params['uploadUrl']) . $basePath;
                $model->logoFile->saveAs($path);
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Payment method updated success');

                return $this->redirect(['payment/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
       $model = DepositMethod::findOne($id);
       $model->delete();
       $model->unlinkAll('reviews',true);

       Yii::$app->getSession()->setFlash('success', 'success of deleting '.$model->title);
       return $this->redirect(['payment/index']);
    }
}