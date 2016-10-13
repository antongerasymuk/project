<?php
namespace backend\controllers;

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



    public function actionCreate()
    {
        $model = new Bonus();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->params;

            $logoFile = UploadedFile::getInstance($model, 'logoFile');
            $path = Url::to($params['uploadPath']) . $logoFile->baseName . '.' . $logoFile->extension;

            // store the source file name
            $model->logo = $params['uploadUrl'] . $logoFile->baseName . '.' . $logoFile->extension;
 echo "<pre>";
                       var_dump($model);
                       echo "</pre>";
                       exit;


            if($model->save()) {
            if (!empty($model->osIds)) {
                        foreach ($model->osIds as $id) {
                            $model->link('oses', Os::findOne(['id' => $id]));
                        echo "<pre>";
                       var_dump($bonuses);
                       echo "</pre>";
                       exit;
                        }
                    }
            //$logoFile->saveAs($path);
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
}