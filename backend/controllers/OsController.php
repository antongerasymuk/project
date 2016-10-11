<?php
namespace backend\controllers;

use common\models\Os;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class OsController extends BackEndController
{
    public function actionIndex()
    {
        return $this->render('index', [
            'oses' => Os::find()->all()
        ]);
    }

    public function actionCreate()
    {
        $model = new Os();

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            if ($model->logoFile) {
                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                // store the source file name
                $model->src = Url::to(Yii::$app->params['uploadUrl']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

                if($model->save()){
                    $model->logoFile->saveAs($path);
                    Yii::$app->getSession()->setFlash('success', 'Os created success');

                    return $this->redirect(['os/index']);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Os::findOne($id);
        $model->scenario = 'edit';

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');

            if ($model->logoFile) {
                unlink(Url::to('@frontend/web') . $model->src);
                $path = Url::to(Yii::$app->params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                // store the source file name
                $model->src = Yii::$app->params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logoFile->saveAs($path);
            }

            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Os update success');

                return $this->redirect(['os/index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

}