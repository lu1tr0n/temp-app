<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use common\components\Utils;
/**
 * Functions CUrl
 * @link https://www.yiiframework.com/extension/yii2-curl
 */
use linslin\yii2\curl;
/**
 * Client REST API
 * @link https://www.yiiframework.com/extension/yiisoft/yii2-httpclient
 */
use yii\httpclient\Client;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex() {
        $this->redirect(['/site/profile']);
    }    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDashboard() {
        Utils::as_begin_session();
        return $this->render('dashboard');
    }

    public function actionProfile() {
        /**
         * Define variable
         */
        $urlApi = Yii::$app->params['urlApi'];
        $session = Yii::$app->session;
        // Utils::as_begin_session();

        try {
            
            $user_id = $session->get('user-id');
            $username = $session->get('username');
            $basic_auth = $session->get('auth');

            $client = new Client(['baseUrl' => $urlApi.'/user/'.$user_id]);
            $request = $client->createRequest()
                ->setHeaders(['content-type' => 'application/json']);               
            $request->headers->set('Authorization', 'Basic ' . $basic_auth);
            $response = $request->send();
            
            if ($response->data['data']['state']) {
                return $this->render('profile', ['data' => $response->data['data']]);
                // return $this->redirect(['/site/profile']);
            } else {

                return $this->redirect(['/login/index']);
            }
            /**
             * Finish 
             */
            Yii::$app->session->close();
            die();
        } catch(\yii\httpclient\Exception $exception) {
            return $this->redirect(['/login/index']);
        }        
    }
}
