<?php
namespace frontend\controllers;

use common\models\Categorie;
use common\models\Company;
use common\models\Review;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
//use frontend\models\Contact;
use frontend\models\ContactForm;


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
    'access' => [
    'class' => AccessControl::className(),
    'only' => ['logout', 'signup'],
    'rules' => [
    [
    'actions' => ['signup'],
    'allow' => true,
    'roles' => ['?'],
    ],
    [
    'actions' => ['logout'],
    'allow' => true,
    'roles' => ['@'],
    ],
    ],
    ],
    'verbs' => [
    'class' => VerbFilter::className(),
    'actions' => [
    'logout' => ['post'],
    ],
    ],
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
    ],
    'captcha' => [
    'class' => 'yii\captcha\CaptchaAction',
    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
    ],
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
    return $this->render('index');
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
// get review data
    $company = Company::find()->with(['reviews' => function($query) use ($id) {
        $query->andWhere(['id' => $id])->with([
            'bonuses',
            'gallery',
            'category',
            'ratings',
            'pros',
            'minuses',
            'oses',
            'deposits'
            ]);
    }])->asArray()->one();

    $this->view->params['company'] = [
    'id' => $company['id'],
    'url' => $company['site_url'],
    'name' => $company['title']
    ];
    $this->view->params['logo'] = $company['logo'];

    return $this->render('review', ['company' => $company]);
}
/**
* Logs in a user.
*
* @return mixed
*/
public function actionLogin()
{
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->goBack();
    } else {
        return $this->render('login', [
            'model' => $model,
            ]);
    }
}

/**
* Logs out the current user.
*
* @return mixed
*/
public function actionLogout()
{
    Yii::$app->user->logout();

    return $this->goHome();
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
    /*$this->layout = "main_contact";

    $model = new Contact();
    var_dump($model);exit;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        Yii::$app->session->setFlash('contactFormSubmitted');

        return $this->render('contact', [

            'model' => $model,

            ]);

    } else {

        return $this->render('contact', [

            'model' => $model,

            ]);

    }}*/


/**
* Displays about page.
*
* @return mixed
*/
public function actionAbout()
{
    return $this->render('about');
}

public function actionSitemap()
{
    return $this->render('sitemap');
}

/**
* Signs user up.
*
* @return mixed
*/
public function actionSignup()
{
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post())) {
        if ($user = $model->signup()) {
            if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }
        }
    }

    return $this->render('signup', [
        'model' => $model,
        ]);
}

/**
* Requests password reset.
*
* @return mixed
*/
public function actionRequestPasswordReset()
{
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->sendEmail()) {
            Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

            return $this->goHome();
        } else {
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
        }
    }

    return $this->render('requestPasswordResetToken', [
        'model' => $model,
        ]);
}

/**
* Resets password.
*
* @param string $token
* @return mixed
* @throws BadRequestHttpException
*/
public function actionResetPassword($token)
{
    try {
        $model = new ResetPasswordForm($token);
    } catch (InvalidParamException $e) {
        throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
        Yii::$app->session->setFlash('success', 'New password was saved.');

        return $this->goHome();
    }

    return $this->render('resetPassword', [
        'model' => $model,
        ]);
}

public function actionCategory($id)
{
    $this->layout = 'main_bonus';

    return $this->render('bonuses_by_filter', ['title' => Categorie::findOne($id)->title]);
}
}
