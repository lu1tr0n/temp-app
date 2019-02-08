<?php
namespace common\components;

use Yii;
use yii\helpers;
use yii\helpers\Url;

class Utils {

    /**
     * Function that allows begin session
     *
     * @param $None
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return None
     */    
    public function as_begin_session() {
        Yii::$app->session->open();
        if (!(Yii::$app->session->isActive && trim(Yii::$app->session->get('auth')) != "")) {
            self::end_session();
            header('Location: '.Yii::$app->urlManager->createUrl('/'));
            die();
        }
        Yii::$app->session->close();
    }

    /**
     * Function that allows delete session
     *
     * @param None
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return None
     */
    public function end_session() {
        Yii::$app->session->remove('user-id');
        Yii::$app->session->remove('username');
        Yii::$app->session->remove('auth');
        Yii::$app->session->destroy();
    }

    /**
     * Function that allows convert object to array
     *
     * @param $object
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return Array of elements
     */
    public function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        }
        else $new = $obj;
        return $new;       
    }
}