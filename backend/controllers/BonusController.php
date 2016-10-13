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
        $model = new Bonus();;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $params = Yii::$app->params;
            $logoFile = UploadedFile::getInstance($model, 'logoFile');
            $path = Url::to($params['uploadPath']) . $logoFile->baseName . '.' . $logoFile->extension;

            // store the source file name
            $model->logo = Url::to($params['uploadUrl']) . $logoFile->baseName . '.' . $logoFile->extension;
            if ($isAjax) {
                $logoFile->saveAs($path);
                if (!empty($model->osIds)) {
                        foreach ($model->osIds as $id) {
                            $model->link('oses', Os::findOne(['id' => $id]));
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

            Yii::$app->getSession()->setFlash('success', 'Bonus created success');

            return $this->redirect(['bonus/index']);
        }

        return $this->render('create', ['model' => $model]);
    } 
     public function actionEdit($id)
    {
        $model = Bonus::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty($model->osIds)) {
                foreach ($model->osIds as $id) {
                    $model->link('oses', Os::findOne(['id' => $id]));
                }
            }
            if (!empty($model->logoFile)) {
                unlink(Url::to('@frontend/web') . $model->logo);
                $logoPath = Url::to($params['uploadPath']) . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logo = $params['uploadUrl'] . $model->logoFile->baseName . '.' . $model->logoFile->extension;
                $model->logoFile->saveAs($logoPath);
            }      

            Yii::$app->getSession()->setFlash('success', 'Bonus update success');
            
            return $this->redirect(['bonus/index']);
        } 
        $model->osIds = ArrayHelper::map($model
            ->getOses()
            ->select('id')
            ->asArray()
            ->all(), 'id', 'id');

        

        return $this->render('update', ['model' => $model]);
    }


}