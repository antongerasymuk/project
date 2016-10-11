<?php
namespace backend\controllers;

use common\models\DepositMethod;
use common\models\Os;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

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

    public function actionCreate()
    {
        $model = new DepositMethod();

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            if ($model->logoFile) {
                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                // store the source file name
                $model->logo = Url::to(Yii::$app->params['uploadUrl']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                if($model->save()){
                    $model->logoFile->saveAs($path);
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
                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                // store the source file name
                $model->logo = Url::to(Yii::$app->params['uploadUrl']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logoFile->saveAs($path);
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Payment method updated success');

                return $this->redirect(['payment/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }
}