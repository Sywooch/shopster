<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\models\Register;
use yii\web\Response;

class DefaultController extends Controller
{
    public function init(){
        $this->enableCsrfValidation = false;
    }
    public function actionInfo()
    {
    	$this->enableCsrfValidation = false;
    	
        echo "string";
    }
    public function actionPush(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if(isset($_POST['push_id'])){
            $model = new Register();
            $model->push_id = $_POST['push_id'];
            $model->os = $_POST['os'];
            $model->save();
        }
    }
}
