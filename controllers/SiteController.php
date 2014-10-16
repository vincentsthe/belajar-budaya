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
use app\models\db\Room;
use app\models\db\Answer;
use app\models\db\RoomQuestion;
use yii\data\ActiveDataProvider;
use yii\web\Session;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;

class SiteController extends Controller
{
    public $defaultAction = 'home';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','game','home'],
                'rules' => [
                    [
                        //allow authenticated request
                        'actions' => ['logout','game','home'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [

                        'actions' => ['game','home'],
                        'allow' => false,
                        'roles' => ['?']
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

    public function actionFblogin(){
        $helper = new FacebookRedirectLoginHelper(Yii::$app->urlManager->createAbsoluteUrl(['site/checkfblogin']));
        return $this->redirect($helper->getLoginUrl());
    }

    public function actionCheckfblogin(){
        
        $helper = new FacebookRedirectLoginHelper(Yii::$app->urlManager->createAbsoluteUrl(['site/checkfblogin']));
        try {
            $fbSession = $helper->getSessionFromRedirect();
            if ($fbSession) {
            //saving 

                $fb_user = (new FacebookRequest(
                  $fbSession, 'GET', '/me'
                ))->execute()->getGraphObject(GraphUser::className());

                //var_dump($fb_user);
                //die("here");
                $fb_picture = (new FacebookRequest(
                  $fbSession,
                  'GET',
                  '/me/picture?redirect=false'
                ))->execute()->getGraphObject();

                if (($model = User::find()->where(['email' => $fb_user->getProperty('email')])->one()) == null){
                    $model = new User;
                }
                //var_dump(expression)
                $model->setFacebookUser($fb_user,$fbSession,$fb_picture->getProperty('url'));
                if ($model->save()){
                    Yii::$app->user->login($model);
                    return $this->redirect(['site/home']);
                } else {
                    var_dump($model->getErrors());
                }               
            } else {
                echo "not logged in";
            }

        } catch(FacebookRequestException $ex) {
            echo $ex->getMessage();
          // When Facebook returns an error
        } catch(\Exception $ex) {
            echo $ex->getMessage();
          // When validation fails or other local issues
        }

        
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
        $room_id = 1;
        $this->layout = '@app/views/layouts/game';
        $answer = new Answer; $answer->room_id = $room_id; $answer->user_id = Yii::$app->user->identity->id; $answer->result = 0;

        $answer->answer = '';

        $room = Room::findOne($room_id);
        //clean-clean
        $room->refreshQuestions();
        $room->deleteOldAnswers();
        //$room->deleteOldQuestions();
        //get 10 last answer
        /*
        $dataProvider = new ActiveDataProvider([
            'query' => Answer::find()->with('user')->orderBy(['id'=>SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);*/

        
        $questions = $room->getActiveQuestions();
                //fetch questions based on room
        if (count($questions) == 0){
            $room->createQuestions();
            $questions = $room->getActiveQuestions();
        }

        //sementara 1 ruangan
        if ($answer->load(Yii::$app->request->post()) && $answer->validate()){
            $answer->match($questions,$room_id);
            if ($answer->save()){
                $user = User::findOne(Yii::$app->user->identity->id); $user->score += $answer->result; $user->save();
            };
        }

        //var_dump($questions);
        $item = $questions[0]->item;
        $query = Yii::$app->db->createCommand('SELECT TIMESTAMPDIFF(second,`created_at`,CURRENT_TIMESTAMP) AS `timeleft` FROM `'.RoomQuestion::tableName().'` WHERE `room_id`='.$room_id.' LIMIT 1')->queryOne();
        return $this->render('game',[
            //'dataProvider' => $dataProvider,
            'chat' => Answer::find()->with('user')->orderBy(['id'=>SORT_DESC])->limit(11)->all(),
            'answer' => $answer,
            'score' => User::find()->where(['id'=>Yii::$app->user->identity->id])->one()->score,
            'item' => $item,
            'questions' => $questions,
            'timeleft' => $query['timeleft'],
            'room_id' => $room_id
        ]);
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
                    //update image url
                    $item->image_url = 'img/items/' . $item->id . '.' . $model->gambar->extension; $item->save();

                    Yii::$app->session->setFlash('success', 'Data berhasil dikirimkan.');
                    $model->gambar->saveAs('img/items/' . $item->id . '.' . $model->gambar->extension);
                    $model = new ItemForm();
                }
            }
        }

        return $this->render('additem', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    public function beforeAction($action){
        if (parent::beforeAction($action)){
            FacebookSession::setDefaultApplication(Yii::$app->params['fb_app_id'],Yii::$app->params['fb_app_secret']);
            $session = new Session(); $session->open();
            return true;
        } else {
            return false;
        }
    }
}
