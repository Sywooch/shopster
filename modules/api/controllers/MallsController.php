<?php

namespace app\modules\api\controllers;

use app\models\City;
use app\models\Category;
use yii\web\Response;
use app\models\UserContent;
use app\models\Promo;

class MallsController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
    	$this->enableCsrfValidation = false;

    	$mall = UserContent::findOne($id);
    	$promo = Promo::find()->where(['content_id' => $mall->id])->one();
        $shops = json_decode($mall->shops, true);
        $a = [];
        if(!empty($shops))
            foreach ($shops as $s) {
                $shop = UserContent::findOne($s);
                $a[] = ['id' => $shop->id, 'title' => $shop->title, 'image' => $shop->imageurl];
            }
        $promos = [];
        if(!empty($promo))
            $promos[] = ['id' => $mall->id, 'title' => $mall->title, 'image' => $promo->id, 'description' => $promo->description, 'duration' => $promo->duration];
        $maps = json_decode($mall->maps, true);
        $maps_imgs = [];
        if(!empty($maps)){
            $asd = 0;
            foreach ($maps as $key => $value) {
                $maps_imgs[] = [$key + 1 => "/images/maps/".$value];

                $asd += 1;
            }
        }

    	$array = ['banner' => $mall->bannerUrl, 'phone' => $mall->phone, 'website' => $mall->website, 'working_hours' => $mall->working_hours, 'map_img' => $mall->mapUrl,
    		'promos' => $promos,
            'shops' => $a,
            'maps' => $maps_imgs,
    	];
    	$array = json_encode($array);
    	print_r($array);
    }
    public function actionCity($id){
        
        $this->enableCsrfValidation = false;

    	$malls = UserContent::find()->where(['city_id' => $id, 'status' => 1, 'category_id' => 2])->all();
    	$array = [];
    	foreach ($malls as $mall) {
    		$array[] = ['id' => $mall->id, 'title' => $mall->title, 'image' => $mall->imageUrl, 'description' => $mall->description, 'latitude' => $mall->latitude, 'longitude' => $mall->longitude];
    	}
    	$array = json_encode($array);
    	print_r($array);
    }
}
