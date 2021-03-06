<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\db\Item;
use app\models\db\ItemCategory;
use app\models\form\FacebookLoginForm;
use app\models\ContactForm;
use app\models\form\ItemForm;
use app\models\factory\ItemFactory;
use app\models\db\User;


class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FacebookLoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $userModel = User::find(['fb_id' => $model->fb_id])->one();
            if ($userModel === null){
                $userModel = new User;
            }
            $userModel->fb_id = $model->fb_id; $userModel->fb_access_token;
            if ($model->save() &&  $model->loginByAccessToken($model->fb_access_token)){
                $this->redirect(['site/home']);
            }
            $this->render('login',['model' => $model]);
        } else {
            
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGame() {
        $this->layout = 'plain';
        return $this->render('game');
    }

    public function actionHome() {
        $items = Item::find()->limit(3)->all();
        $ranks = User::find()->orderBy(['score' => SORT_DESC])->limit(5)->all();

        return $this->render('home',[
            'items' => $items,
            'ranks' => $ranks,
        ]);
    }

    public function actionWiki() {
        return $this->render('wiki');
    }

    public function actionAdditem() {
        $model = new ItemForm();
        $categories = ItemCategory::find()->all();

        if((Yii::$app->request->isPost) && ($model->load(Yii::$app->request->post()))) {
            $model->gambar = UploadedFile::getInstance($model, 'gambar');

            if($model->validate()) {
                $item = ItemFactory::createItemFromItemForm($model);

                if($item->save()) {
                    Yii::$app->session->setFlash('success', 'Data berhasil dikirimkan.');
                    $model->gambar->saveAs('uploads/' . $model->gambar->baseName . '.' . $model->gambar->extension);
                    $model = new ItemForm();
                }
            }
        }

        return $this->render('additem', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }
}
