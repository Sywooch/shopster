<?php

namespace app\modules\api\controllers;

use app\models\City;
use app\models\Category;
use yii\web\Response;
use app\models\UserContent;
use app\models\Promo;

class PromoController extends \yii\web\Controller
{
    public function actionCity($id){
        
        $this->enableCsrfValidation = false;

        $promos = Promo::find()->all();
        $res = [];
        foreach ($promos as $promo) {
        	$shop = UserContent::findOne($promo->content_id);
        	if($shop->city_id == $id && $shop->category_id == 1){
        		$res[] = ['id' => $shop->id, 'title' => $shop->title, 'image' => $promo->imageUrl, 'description' => $promo->description, 'duration' => $promo->duration, 'paid_status' => $promo->paid];
        	}
        }
        $res = json_encode($res);
        print_r($res);
    }
}
