<?php
namespace backend\controllers;

use yii\helpers\ArrayHelper;
use common\models\Bonus;
use common\models\Os;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Company controller
 */
class BonusController extends BackEndController
{
    public function actionIndex()
    {
        $bonuses = Bonus::find()->all();
        //echo "<pre>";
        //var_dump($bonuses);
        //echo "</pre>";
        return $this->render('index', ['bonuses' => $bonuses]);

    }

    public function actionCreate($isAjax = true)
    {
        $model = new Bonus();

        if ($model->load(Yii::$app->request->post())) {

            $params = Yii::$app->params;
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            $path = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

            // store the source file name
            $model->logo = Url::to($params['uploadUrl']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;

            if ($model->save()) {
                $model->logoFile->saveAs($path);

                if (!empty($model->osIds)) {
                    foreach ($model->osIds as $id) {
                        $model->link('oses', Os::findOne(['id' => $id]));
                    }
                }
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

                Yii::$app->getSession()->setFlash('success', 'Bonus created success');

                return $this->redirect(['bonus/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Bonus::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            $params = Yii::$app->params;
            if (!empty($model->osIds)) {
                foreach ($model->osIds as $id) {
                    $model->link('oses', Os::findOne(['id' => $id]));
                }
            }
            if (!empty($model->logoFile)) {

                unlink(Url::to('@frontend/web') . $model->logo);

                $logoPath = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logo = $params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;

            }
            if ($model->save()) {
                $model->logoFile->saveAs($logoPath);
                if (!empty($model->osIds)) {
                    foreach ($model->osIds as $id) {
                        $model->link('oses', Os::findOne(['id' => $id]));
                    }
                }
                Yii::$app->getSession()->setFlash('success', 'Bonus update success');

                return $this->redirect(['bonus/index']);
            }
        }
        $model->osIds = ArrayHelper::map($model
            ->getOses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Bonus::findOne($id);
        $model->delete();
        $model->unlinkAll('oses', true);

        return $this->redirect(['bonus/index']);
    }


}