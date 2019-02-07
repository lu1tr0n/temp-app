<?php
    /**
     * @since 2019-02-05
     * @author Luis Navarro <lu1tr0n>
     */

    namespace app\controllers;

    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\Response;
    use yii\filters\VerbFilter;
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

    /**
     * Import model User
     */
    use yii\helpers\Url;
    use app\models\LoginForm;
    use yii\helpers\ArrayHelper;
    use common\components\Utils;
    
    class LoginController extends Controller {

        /* {@inheritdoc}
        */
       public function behaviors() {
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
        * @description Unable to verify your data submission
        * @link https://stackoverflow.com/questions/38299474/yii2-bad-request-400-unable-to-verify-your-data-submission
        */
       public function beforeAction($action) { 
           $this->enableCsrfValidation = false; 
           return parent::beforeAction($action); 
       }

        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex() {
            /**
             * Define variable
             */
            $urlApi = Yii::$app->params['urlApi'];
            Utils::as_begin_session();
            Yii::$app->session->setFlash('error', "Username or Password incorrect!.");
            if (Yii::$app->request->post()) {
                Yii::$app->session->open();
                try {
                    $username = Yii::$app->request->post('inputEmail');
                    $password = Yii::$app->request->post('inputPassword');

                    $client = new Client(['baseUrl' => $urlApi.'/profile']);
                    $request = $client->createRequest()
                        ->setHeaders(['content-type' => 'application/json']);               
                    $request->headers->set('Authorization', 'Basic ' . base64_encode("$username:$password"));
                    $response = $request->send();
                    
                    if ($response->data['ok'] == '1') {
                        Yii::$app->session->set('user-id', $response->data['user']['_id']);
                        Yii::$app->session->set('username', $response->data['user']['username']);
                        Yii::$app->session->set('auth', base64_encode("$username:$password"));
                        return $this->redirect(['/site/dashboard']);
                    } else {
                        Yii::$app->session->setFlash('error', "Username or Password incorrect!.");
                        return $this->redirect(['/login/index']);
                    }
                    /**
                     * Finish 
                     */
                    Yii::$app->session->close();
                    die();
                } catch(\yii\httpclient\Exception $exception) {
                    Yii::$app->session->setFlash('error', "Username or Password incorrect!.");
                    return $this->redirect(['/login/index']);
                }
            }
            
            return $this->renderPartial('index');
        }

        /**
         * Logout action.
         *
         * @return Response
         */
        public function actionLogout() {
            //Utils::end_session();
            //$this->redirect(['/']);
            //return $this->goHome();
            header('Location: /login/index');
        }     
    }