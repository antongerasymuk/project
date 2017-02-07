<?php
namespace frontend\controllers;

use common\models\Categorie;
use common\models\Review;
use Yii;
use yii\web\Controller;
use common\models\Site;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            [
                'class' => 'yii\filters\PageCache',
                'duration' => 300,
                'only' => ['index'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT (SELECT SUM(CRC32(CONCAT(id,pos,title))) FROM categories) + (SELECT SUM(id) FROM companies)+ (SELECT SUM(id) FROM bonuses)',
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_index";

        $siteText = new \backend\models\SiteTextForm;
        $siteText->getMetaTags();
        
        if ($siteText->meta_description) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $siteText->meta_description,
                ]);
        }

        if ($siteText->meta_keywords) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $siteText->meta_keywords,
                ]);
        }

        if ($siteText>meta_title) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'title',
                'content' => $siteText->meta_title,
                ]);
        }
        

        return $this->render('index');
    }


    public function actionPage($category, $slug)
    {
        $site = Site::find()->where(['slug' => $slug, 'category' => $category])->asArray()->one();

        $this->layout = "main";

        return $this->render('page', ['content' => $site['content'], 'title' => $site['title']]);
    }


    public function actionBonuses()
    {
        $this->layout = "main_bonus";

        return $this->render('bonuses_by_filter');
    }

    public function actionCompany()
    {
        $this->layout = "main_review-company";


        return $this->render('company');
    }

    public function actionReview($id)
    {
        $this->layout = "main_review";

        $review = Review::findOne($id);
        $review->getMetaTags();

        if ($review->meta_description) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'description',
                'content' => $review->meta_description,
                ]);
        }

        if ($review->meta_keywords) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $review->meta_keywords,
                ]);
        }

        if ($review->meta_title) {
            \Yii::$app->view->registerMetaTag([
                'name' => 'title',
                'content' => $review->meta_title,
                ]);
        }

        $reviewCompany = Review::findOne(['company_id' => $review->company->id, 'type' => Review::COMPANY_TYPE]);


        if ($review == null) {
            throw new NotFoundHttpException('Review not found');
        }

        $this->view->params['company'] = [
            'id' => $review->company->id,
            'url' => $review->company->site_url,
            'name' => $review->company->title
        ];

        $this->view->params['logo'] = $review->company->logo;
        $this->view->params['review'] = $review;
        $this->view->params['review_company'] = $reviewCompany;

        if ($review->type == Review::REVIEW_TYPE) {
            // render review
            return $this->render('review', ['review' => $review]);
        } elseif ($review->type == Review::COMPANY_TYPE) {
            // render company review
            $this->view->params['is_company'] = true;
            return $this->render('company_review', ['review' => $review]);
        } else {
            throw new NotFoundHttpException('Unknown review type');
        }


    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */


    public function actionContact()
    {
        $this->layout = "main_contact";
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionSitemap()
    {
        return $this->render('sitemap');
    }

    public function actionCategory($id = null)
    {
        $this->layout = 'main_bonus';


        

        if ($categorie = Categorie::findOne($id)) {

            $title = $categorie->title;
            $main_text = $categorie->main_text;
            $notes = $categorie->notes;
            $categorie->getMetaTags();

            if ($categorie->meta_description) {
                \Yii::$app->view->registerMetaTag([
                    'name' => 'description',
                    'content' => $categorie->meta_description,
                ]);
            }
            
            if ($categorie->meta_keywords) {
                \Yii::$app->view->registerMetaTag([
                    'name' => 'keywords',
                    'content' => $categorie->meta_keywords,
                    ]);
            }
            
            if ($categorie->meta_title) {
                \Yii::$app->view->registerMetaTag([
                    'name' => 'title',
                    'content' => $categorie->meta_title,
                    ]);
            }
            


            $this->view->params['category_title'] = $title;
        } else {
            throw new NotFoundHttpException('Unknown category');
        }
        return $this->render('bonuses_by_filter', ['title' => $title , 'main_text' => $main_text, 'notes' => $notes]);
    }
}
