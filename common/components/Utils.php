<?php
namespace common\components;

use Yii;
use yii\helpers as YiiHelper;

class Utils {

    /**
     * Function that allows begin session
     *
     * @param $None
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return None
     */    
    public static function as_begin_session() {
        //Yii::$app->session->open();
        if (!(Yii::$app->session->isActive && Yii::$app->session->get('auth') != "")) {
            Yii::$app->session->destroy();
            header('Location: /login/index');
        }
        //Yii::$app->session->close();
    }

    /**
     * Function that allows delete session
     *
     * @param None
     * 
     * @author Luis Navarro <lu1tr0n>
     * @return None
     */
    public static function end_session() {
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