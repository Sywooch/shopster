<?php

namespace app\modules\api\controllers;

use app\models\City;
use app\models\Category;
use yii\web\Response;
use app\models\UserContent;
use app\models\Promo;

class ShopsController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
    	$this->enableCsrfValidation = false;

        $shop = UserContent::findOne($id);
        $promo = Promo::find()->where(['content_id' => $shop->id])->one();
        $array = [];
        $promo = ['id' => $shop->id, 'image' => $promo->imageurl, 'description' => $promo->description, 'duration' => $promo->duration];
        // $promo = json_encode($promo);
        $malls = UserContent::find()->where(['status' => 1, 'category_id' => 2])->all();
        // $malls = json_decode($model->shops, true);
        $mls = [];
        foreach ($malls as $m) {
            $shops = json_decode($m->shops, true);
            foreach ($shops as $s) {
                if($s == $shop->id){
                    $mls[] = ['id' => $m->id, 'title' => $m->title, 'image' => $m->imageurl, 'description' => $m->description,'latitude' => $m->latitude, 'longitude' => $m->longitude];
                }
            }
            // $mls = UserContent::find()->where(['id' => $m, 'category_id' => 2])->one();
        }
        $array = ['title' => $shop->title,'banner' => $shop->bannerUrl, 'phone' => $shop->phone, 'website' => $shop->website, 'working_hours' => $shop->working_hours, 'map' => $shop->mapUrl, 'city_id' => $shop->city_id, 'image' => $shop->imageurl, 'description' => $shop->description,
            'promos' => [$promo],
            'malls' => $mls,
        ];
        $array = json_encode($array);
        print_r($array);
    }
    public function actionShop($id){
        
        $this->enableCsrfValidation = false;

    	$shop = UserContent::findOne($id);
        $promo = Promo::find()->where(['content_id' => $shop->id])->one();
        $array = ['image' => $shop->imageurl, 'banner' => $shop->bannerUrl, 'phone' => $shop->phone, 'website' => $shop->website, 'working_hours' => $shop->working_hours,
            'map' => $shop->mapUrl, 'city_id' => $shop->city_id, 'shop_category_id' => $shop->shop_category_id,
            'promos' => ['id' => $shop->id, 'image' => $promo->imageurl, 'description' => $promo->description, 'duration' => $promo->duration],
        ];
        $array = json_encode($array);
        print_r($array);
    }
    public function actionCity($id){
        
        $this->enableCsrfValidation = false;

        $malls = UserContent::find()->where(['city_id' => $id, 'status' => 1, 'category_id' => 1])->all();
        $array = [];
        foreach ($malls as $mall) {
            $promo = Promo::find()->where(['content_id' => $mall->id])->one();
            $array[] = ['id' => $mall->id, 'title' => $mall->title, 'image' => $mall->imageUrl, 'description' => $mall->description, 'latitude' => $mall->latitude, 'longitude' => $mall->longitude, 'shop_category_id' => $mall->shop_category_id];
        }
        $array = json_encode($array);
        print_r($array);
    }
}
