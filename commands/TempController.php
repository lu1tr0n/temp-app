<?php
/**
 *
 * @category   Commands
 * @package    TempController
 * @author     Luis Navarro <lu1tr0n>
 * @copyright  1997-2005 The PHP Group
 * @license    https://www.gnu.org/licenses/gpl.txt GNU License 3.0
 * @version    1.0.0
 * @link       https://github.com/lu1tr0n/temp-app
 * @since      File available since Release 1.0.0
 */

namespace app\commands;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\httpclient\Client;

/**
 * description of class
 *
 * Class that allows executing false data entry commands to the database for tests
 *
 * @copyright  Copyright (C) 2019 Free Software Foundation
 * @license    https://www.gnu.org/licenses/gpl.txt GNU License 3.0
 * @version    Release: 1.0.0
 * @link       https://github.com/lu1tr0n/temp-app
 * @since      Class available since Release 1.0.0
 */
class TempController extends Controller
{
    /**
     * define public variables    
     */
    public $username;
    public $password;
    public $howMany;

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'Service add data for command') {
        echo $message . "\n";
        return ExitCode::OK;
    }

    /**
     * Function that allows entering fake data to the database
     *
     * @param $howMany = number of records to enter
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return Boolean
     */
    public function actionAdd($amount = 1) {
        /**
         * Define variables
         */
        $user    = $this->username;
        $pass    = $this->password;
        $hMany   = (intval($this->howMany) > 0) ? intval($this->howMany) : intval($amount);
        $last_id = 0;
        $urlApi  = Yii::$app->params['urlApi'];

        try {
            /**
             * Proccess last register
             * @method GET
             */
            $clientGet = new Client(['baseUrl' => $urlApi.'/temps']);
            $request = $clientGet->createRequest()
                            ->setHeaders(['content-type' => 'application/json']);               
            $request->headers->set('Authorization', 'Basic ' . base64_encode($user.':'.$pass));
            $response = $request->send();
            if ($response->data['ok'] == '1') {
                $last_id = $response->data['count'];
            } 

            /**
             * bucle for send data
             */
            for ($i = 1; $i <= $hMany; $i++) {
                /**
                 * Process 
                 * @method POST
                 */
                $clientPost = new Client();
                $request = $clientPost->createRequest()
                    ->setMethod('POST')
                    ->setUrl($urlApi.'/temp')
                    ->setData(['name' => 'prueba'.$last_id++, 'color' => 'red']);
                $request->headers->set('Authorization', 'Basic ' . base64_encode($user.":".$pass));
                $response = $request->send();
                if ($response->isOk) {
                    //print_r($response->data);die();
                    echo $this->ansiFormat('[Success] New temp data created!: name: '.$response->data['data']['name'].' color:'.$response->data['data']['color']."\n", Console::FG_GREEN);
                }                
            }
        } catch(yii\httpclient\Exception $e) {
            echo $this->ansiFormat('[Error] A problem has occurred. Verify incorrect network or credentials'."\n", Console::FG_RED);
        }
        //echo "Que divertido!\n";
        return ExitCode::OK;
    }

    /**
     * return the options 
     *
     * @param $actionID = name function execute
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return Array for options
     */ 
    public function options($actionID) {
        return ['username', 'password', 'howMany'];
    }

    /**
     * return the options of the arguments
     *
     * @param None
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return Array for arguments
     */ 
    public function optionAliases() {
        return ['u' => 'username', 'p' => 'password', 'a' => 'howMany'];
    }    
}
